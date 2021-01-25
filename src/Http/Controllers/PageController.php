<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreatePageRequest;
use SjorsvanLeeuwen\Webmixx\Http\Requests\EditPageRequest;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;

class PageController extends BaseController
{
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

        $pageTemplates = PageTemplate::withCount('pages')->get();

        $pageTemplates = $pageTemplates->filter(function (PageTemplate $pageTemplate): bool {
            if ($pageTemplate->repeatable) {
                return true;
            }

            return $pageTemplate->getAttribute('pages_count') === 0;
        })->pluck('name', 'id');

        return view('webmixx::pages.create', compact('pageTemplates'));
    }

    public function store(CreatePageRequest $request): RedirectResponse
    {
        $this->authorize('create', Page::class);

        $page = new Page();
        $page->fill($request->validated());
        $page->page_template_id = $request->input('page_template_id');

        $page->save();

        $pageAttributeTemplates = $page->pageTemplate->pageAttributeTemplates;

        foreach($request->input('attributes') as $pageAttributeTemplateId => $value) {
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

        $page->load([
            'pageTemplate',
            'pageTemplate.pageAttributeTemplates',
            'pageAttributes',
        ]);

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

        foreach($request->input('attributes') as $pageAttributeTemplateId => $value) {
            $this->saveAttribute($page, $pageAttributeTemplates, $pageAttributeTemplateId, $value);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $page->pageAttributes()->whereIn('id', $oldAttributeIds)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('webmixx.pages.index');
    }

    /**
     * @param Page $page
     * @param Collection $pageAttributeTemplates
     * @param int $pageAttributeTemplateId
     * @param array|string $value
     * @param ?int $parentPageAttributeId
     * @param int $order
     */
    protected function saveAttribute(Page $page, Collection $pageAttributeTemplates, int $pageAttributeTemplateId, $value, ?int $parentPageAttributeId = null, int $order = 0): void
    {
        $pageAttributeTemplate = $pageAttributeTemplates->firstWhere('id', $pageAttributeTemplateId);

        if ($pageAttributeTemplate->repeatable && is_numeric(array_key_first($value)) === false) {
            for ($index = 0; $index < count($value); $index++) {
                $childValue = array_values($value)[$index];
                $this->saveAttribute($page, $pageAttributeTemplates, $pageAttributeTemplateId, $childValue, $parentPageAttributeId, $index);
            }
        } else if ($pageAttributeTemplate->field_type === FieldTypes::COMPOUND) {
            $pageAttribute = $page->pageAttributes()->make([
                'value' => null,
            ]);
            $pageAttribute->order = $order;
            $pageAttribute->page_attribute_template_id = $pageAttributeTemplateId;
            $pageAttribute->page_attribute_id = $parentPageAttributeId;
            $pageAttribute->save();

            foreach ($value as $key => $childValue) {
                $this->saveAttribute($page, $pageAttributeTemplates, $key, $childValue, $pageAttribute->id);
            }
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

    public function destroy(Page $page): void
    {
        $this->authorize('delete', $page);
    }
}
