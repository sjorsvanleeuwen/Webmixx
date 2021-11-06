<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreatePageTemplateRequest;
use SjorsvanLeeuwen\Webmixx\Http\Requests\EditPageTemplateRequest;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;

class PageTemplateController extends BaseController
{
    public function index(): ViewContract
    {
        $this->authorize('viewAny', PageTemplate::class);

        Paginator::useBootstrap();

        $pageTemplates = PageTemplate::query()->paginate();

        return view('webmixx::page_templates.index', compact('pageTemplates'));
    }

    public function create(): ViewContract
    {
        $this->authorize('create', PageTemplate::class);

        return view('webmixx::page_templates.create');
    }

    public function store(CreatePageTemplateRequest $request): RedirectResponse
    {
        $this->authorize('create', PageTemplate::class);

        $pageTemplate = new PageTemplate();
        $pageTemplate->fill($request->validated());
        $pageTemplate->slug = Str::slug($pageTemplate->name, '_');

        $pageTemplate->save();

        return redirect()->route('webmixx.page_template.index');
    }

    public function show(PageTemplate $pageTemplate): ViewContract
    {
        $this->authorize('view', $pageTemplate);

        return view('webmixx::page_templates.show', compact('pageTemplate'));
    }

    public function edit(PageTemplate $pageTemplate): ViewContract
    {
        $this->authorize('update', $pageTemplate);

        return view('webmixx::page_templates.edit', [
            'pageTemplate' => $pageTemplate,
        ]);
    }

    public function update(EditPageTemplateRequest $request, PageTemplate $pageTemplate): RedirectResponse
    {
        $this->authorize('update', $pageTemplate);

        $pageTemplate->fill($request->validated());
        $pageTemplate->slug = Str::slug($pageTemplate->name, '_');

        $pageTemplate->save();

        return redirect()->route('webmixx.page_template.index');
    }

    public function destroy(PageTemplate $pageTemplate): RedirectResponse
    {
        $this->authorize('delete', $pageTemplate);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $pageTemplate->pageAttributeTemplates()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $pageTemplate->delete();

        return redirect()->route('webmixx.page_template.index');
    }
}
