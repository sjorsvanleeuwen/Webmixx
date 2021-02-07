<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Menus;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use SjorsvanLeeuwen\Webmixx\Models\Menu as MenuModel;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;

class Menu extends Component
{
    public MenuModel $menu;

    public function __construct(string $menu)
    {
        $this->menu = MenuModel::query()->where('slug', $menu)
            ->with('menuItems')->firstOrFail();
    }

    public function render(): ViewContract
    {
        /** @phpstan-var view-string $template_path */
        $template_path = config('webmixx.templateBasePath') . '.menus.' . $this->menu->slug;

        return view($template_path, [
            'menuItems' => $this->menu->rootMenuItems,
        ]);
    }

    public function hasChildItems(MenuItem $menuItem): bool
    {
        return $this->menu->menuItems->where('menu_item_id', $menuItem->id)->isNotEmpty();
    }

    public function getChildItems(MenuItem $menuItem): Collection
    {
        return $this->menu->menuItems->where('menu_item_id', $menuItem->id);
    }
}
