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
        /** @var MenuItem $menuItem */
        $menuItem = MenuItem::where('full_slug', '/' . $fallbackPlaceholder ?? '/')->firstOrFail();

        if ($menuItem->link_type === Page::class) {
            return $this->showPage($menuItem->link_id);
        }

        $moduleName = strtolower((new \ReflectionClass($menuItem->link_type))->getShortName());
        $template_path = $this->webmixx->getTemplateViewPath('content_types', $moduleName);

        return view($template_path, [
            $moduleName => $menuItem->link,
        ]);
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
