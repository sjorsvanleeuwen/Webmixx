<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreatePageAttributeTemplateRequest;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;

class PageAttributeTemplateController extends BaseController
{
    public function index(): ViewContract
    {
        $this->authorize('viewAny', PageAttributeTemplate::class);

        Paginator::useBootstrap();

        $pageAttributeTemplates = PageAttributeTemplate::query()->with('pageTemplate')->paginate();

        return view('webmixx::page_attribute_templates.index', compact('pageAttributeTemplates'));
    }

    public function create(): ViewContract
    {
        $this->authorize('create', PageAttributeTemplate::class);

        $pageTemplates = PageTemplate::query()->pluck('name', 'id');
        $pageAttributeTemplates = PageAttributeTemplate::query()->where('field_type', '=', FieldTypes::COMPOUND)->pluck('name', 'id');
        $fieldTypes = FieldTypes::getAll();

        return view('webmixx::page_attribute_templates.create', compact('pageTemplates', 'pageAttributeTemplates', 'fieldTypes'));
    }

    public function store(CreatePageAttributeTemplateRequest $request): RedirectResponse
    {
        $this->authorize('create', PageAttributeTemplate::class);

        $pageAttributeTemplate = new PageAttributeTemplate();
        $pageAttributeTemplate->fill($request->validated());
        $pageAttributeTemplate->page_template_id = $request->input('page_template_id');
        $pageAttributeTemplate->page_attribute_template_id = $request->input('page_attribute_template_id', null);
        $pageAttributeTemplate->slug = Str::slug($pageAttributeTemplate->name, '_');

        $pageAttributeTemplate->save();

        return redirect()->route('webmixx.page_attribute_templates.index');
    }

    public function show(PageAttributeTemplate $pageAttributeTemplate): void
    {
        $this->authorize('view', $pageAttributeTemplate);
    }

    public function edit(PageAttributeTemplate $pageAttributeTemplate): void
    {
        $this->authorize('update', $pageAttributeTemplate);
    }

    public function update(PageAttributeTemplate $pageAttributeTemplate): void
    {
        $this->authorize('update', $pageAttributeTemplate);
    }

    public function destroy(PageAttributeTemplate $pageAttributeTemplate): void
    {
        $this->authorize('delete', $pageAttributeTemplate);
    }
}
