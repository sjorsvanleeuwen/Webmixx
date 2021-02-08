<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class FrontController extends BaseController
{
    protected Webmixx $webmixx;

    public function __construct(Webmixx $webmixx)
    {
        $this->webmixx = $webmixx;
    }

    public function handle(?string $fallbackPlaceholder = null): ViewContract
    {
        // look it up in menuItems
        $menuItem = MenuItem::where('full_slug', '/' . $fallbackPlaceholder ?? '/')->first();

        if ($menuItem) {
            $moduleName = (new \ReflectionClass($menuItem->link))->getShortName();
            $functionName = 'show' . $moduleName;

            return $this->{$functionName}($menuItem->link_id);
        }

        return view('webmixx::dashboard');
    }

    public function preview(string $module, int $id): ViewContract
    {
        return $this->showPage($id);
    }

    protected function showPage(int $id): ViewContract
    {
        /** @var Page $page */
        $page = Page::with('pageTemplate', 'pageTemplate.pageAttributeTemplates', 'pageAttributes')->find($id);

        $template_path = $this->webmixx->getTemplateViewPath(Page::moduleName(), $page->pageTemplate->slug);

        return view($template_path, compact('page'));
    }
}
