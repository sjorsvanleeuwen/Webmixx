<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;

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

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Page::class);

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

    public function edit(Page $page): void
    {
        $this->authorize('update', $page);
    }

    public function update(Page $page): void
    {
        $this->authorize('update', $page);
    }

    public function destroy(Page $page): void
    {
        $this->authorize('delete', $page);
    }
}
