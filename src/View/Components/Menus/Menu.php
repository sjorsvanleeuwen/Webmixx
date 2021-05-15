<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Menus;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use SjorsvanLeeuwen\Webmixx\Models\Menu as MenuModel;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem as MenuItemModel;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class Menu extends Component
{
    public MenuModel $menu;

    protected Webmixx $webmixx;

    public function __construct(Webmixx $webmixx, string $menu)
    {
        $this->webmixx = $webmixx;

        $this->menu = MenuModel::query()->where('slug', $menu)
            ->with('menuItems')->firstOrFail();
    }

    public function render(): ViewContract
    {
        $template_path = $this->webmixx->getTemplateViewPath(MenuModel::moduleName(), $this->menu->slug);

        return view($template_path, [
            'menuItems' => $this->menu->getRootMenuItems(),
        ]);
    }

    public function hasChildItems(MenuItemModel $menuItem): bool
    {
        return $this->menu->menuItems->where('menu_item_id', $menuItem->id)->isNotEmpty();
    }

    public function getChildItems(MenuItemModel $menuItem): Collection
    {
        return $this->menu->menuItems->where('menu_item_id', $menuItem->id);
    }
}
