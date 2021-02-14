<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreatePageRequest;
use SjorsvanLeeuwen\Webmixx\Http\Requests\EditPageRequest;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class PageController extends BaseController
{
    protected Webmixx $webmixx;

    public function __construct(Webmixx $webmixx)
    {
        $this->webmixx = $webmixx;
    }

    public function index(): ViewContract
    {
        $this->authorize('viewAny', Page::class);

        Paginator::useBootstrap();

        $pages = Page::query()->with('pageTemplate')->paginate();
        $moduleName = Page::moduleName();

        return view('webmixx::pages.index', compact('pages', 'moduleName'));
    }

    public function create(): ViewContract
    {
        $this->authorize('create', Page::class);

        return view('webmixx::pages.create');
    }

    public function store(CreatePageRequest $request): RedirectResponse
    {
        $this->authorize('create', Page::class);

        $page = new Page();
        $page->fill($request->validated());
        $page->page_template_id = $request->input('page_template_id');

        $page->save();

        $pageAttributeTemplates = $page->pageTemplate->pageAttributeTemplates;

        foreach ($request->input('attributes') as $pageAttributeTemplateId => $value) {
            $this->saveAttribute($page, $pageAttributeTemplates, $pageAttributeTemplateId, $value);
        }

        return redirect()->route('webmixx.pages.index');
    }

    public function show(Page $page): RedirectResponse
    {
        $this->authorize('view', $page);

        return redirect()->route('webmixx.preview', [
            Page::moduleName(),
            $page,
        ]);
    }

    public function edit(Page $page): ViewContract
    {
        $this->authorize('update', $page);

        $pageTemplates = [
            $page->pageTemplate->id => $page->pageTemplate->name,
        ];

        return view('webmixx::pages.edit', compact('page', 'pageTemplates'));
    }

    public function update(EditPageRequest $request, Page $page): RedirectResponse
    {
        $this->authorize('update', $page);

        $oldAttributeIds = $page->pageAttributes->pluck('id');

        $page->name = $request->input('name');
        $page->save();

        $pageAttributeTemplates = $page->pageTemplate->pageAttributeTemplates;

        foreach ($request->all('attributes')['attributes'] as $pageAttributeTemplateId => $value) {
            $this->saveAttribute($page, $pageAttributeTemplates, $pageAttributeTemplateId, $value);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $page->pageAttributes()->whereIn('id', $oldAttributeIds)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('webmixx.pages.index');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $this->authorize('delete', $page);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $page->pageAttributes()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $page->delete();

        return redirect()->route('webmixx.pages.index');
    }

    /**
     * @param array|string|UploadedFile $value
     * @param ?int $parentPageAttributeId
     */
    protected function saveAttribute(Page $page, Collection $pageAttributeTemplates, int $pageAttributeTemplateId, $value, ?int $parentPageAttributeId = null, int $order = 0): void
    {
        $pageAttributeTemplate = $pageAttributeTemplates->firstWhere('id', $pageAttributeTemplateId);

        if ($pageAttributeTemplate->repeatable && is_array($value) && is_numeric(array_key_first($value)) === false) {
            for ($index = 0; $index < count($value); $index++) {
                $childValue = array_values($value)[$index];
                $this->saveAttribute($page, $pageAttributeTemplates, $pageAttributeTemplateId, $childValue, $parentPageAttributeId, $index);
            }
        } elseif ($pageAttributeTemplate->field_type === FieldTypes::COMPOUND && is_array($value)) {
            $pageAttribute = $page->pageAttributes()->make([
                'value' => null,
            ]);
            $pageAttribute->order = $order;
            $pageAttribute->page_attribute_template_id = $pageAttributeTemplateId;
            $pageAttribute->page_attribute_id = $parentPageAttributeId;
            $pageAttribute->save();

            foreach ($value as $key => $childValue) {
                $this->saveAttribute($page, $pageAttributeTemplates, intval($key), $childValue, $pageAttribute->id);
            }
        } elseif ($pageAttributeTemplate->field_type === FieldTypes::IMAGE) {
            if ($value instanceof UploadedFile) {
                $filename = Str::random(32);
                $disk = $this->webmixx->getPublicUploadDisk();
                $path = $disk->putFileAs($this->webmixx->getUploadDirectory(), $value, $filename . '.' . $value->extension());
            } else {
                $path = $value;
            }

            $pageAttribute = $page->pageAttributes()->make([
                'value' => $path,
            ]);
            $pageAttribute->order = $order;
            $pageAttribute->page_attribute_template_id = $pageAttributeTemplateId;
            $pageAttribute->page_attribute_id = $parentPageAttributeId;
            $pageAttribute->save();
        } else {
            $pageAttribute = $page->pageAttributes()->make([
                'value' => $value,
            ]);
            $pageAttribute->order = $order;
            $pageAttribute->page_attribute_template_id = $pageAttributeTemplateId;
            $pageAttribute->page_attribute_id = $parentPageAttributeId;
            $pageAttribute->save();
        }
    }
}
