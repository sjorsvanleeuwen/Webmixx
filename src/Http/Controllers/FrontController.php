<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use SjorsvanLeeuwen\Webmixx\Models\Page;

class FrontController extends BaseController
{
    public function handle(string $module, int $id): ViewContract
    {
        return $this->showPage($id);
    }

    protected function showPage(int $id): ViewContract
    {
        /** @var Page $page */
        $page = Page::with('pageTemplate', 'pageTemplate.pageAttributeTemplates', 'pageAttributes')->find($id);

        /** @phpstan-var view-string $template_path */
        $template_path = config('webmixx.templateBasePath') . '.pages.' . $page->pageTemplate->slug;

        return view($template_path, compact('page'));
    }
}
