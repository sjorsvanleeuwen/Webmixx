<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreateMenuItemRequest;
use SjorsvanLeeuwen\Webmixx\Http\Requests\EditMenuItemRequest;
use SjorsvanLeeuwen\Webmixx\Http\Resources\MenuItemResource;
use SjorsvanLeeuwen\Webmixx\Models\Menu;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class MenuItemController extends BaseController
{
    public function store(CreateMenuItemRequest $request, Menu $menu): JsonResource
    {
        $this->authorize('create', [MenuItem::class, $menu]);

        /** @var Webmixx $webmixx */
        $webmixx = app(Webmixx::class);

        $data = $request->validated();

        /** @var MenuItem $menuItem */
        $menuItem = $menu->menuItems()->make();
        $menuItem->link_type = $webmixx->getMenuModelClass($data['link_type']);
        $menuItem->link_id = $data['link_id'];
        $menuItem->name = $data['name'];
        $menuItem->slug = Str::slug($menuItem->name);
        $menuItem->full_slug = '/' . $menuItem->slug;
        $menuItem->order = $menu->rootMenuItems->count();
        $menuItem->save();

        return new MenuItemResource($menuItem);
    }

    public function update(EditMenuItemRequest $request, Menu $menu, MenuItem $menuItem): JsonResource
    {
        $this->authorize('update', $menuItem);

        $original_menu_item_id = $menuItem->menu_item_id;
        $original_order = $menuItem->order;

        $menuItem->menu_item_id = $request->input('menu_item_id');
        $menuItem->load('menuItem');
        $menuItem->name = $request->input('name');
        $menuItem->slug = Str::slug($menuItem->name);
        $menuItem->order = $request->input('order');

        if ($menuItem->menuItem !== null) {
            $menuItem->full_slug = $menuItem->menuItem->full_slug . '/' . $menuItem->slug;
        } elseif($menuItem->order === 0) {
            $menuItem->full_slug = '/';

        } else {
            $menuItem->full_slug = '/' . $menuItem->slug;
        }
        $menuItem->save();

        if ($menuItem->wasChanged('menu_item_id')) {
            $this->incrementSubElementOrder($menu->menuItems(), 'menu_item_id', $menuItem->menu_item_id, $menuItem->order, null, $menuItem->id);

            $this->decrementSubElementOrder($menu->menuItems(), 'menu_item_id', $original_menu_item_id, $original_order);
        } else if ($menuItem->wasChanged('order')) {
            if ($original_order < $menuItem->order) {
                $this->decrementSubElementOrder($menu->menuItems(), 'menu_item_id', $menuItem->menu_item_id, $original_order, $menuItem->order, $menuItem->id);
            } else {
                $this->incrementSubElementOrder($menu->menuItems(), 'menu_item_id', $menuItem->menu_item_id, $menuItem->order, $original_order, $menuItem->id);
            }
        }

        return MenuItemResource::collection($menu->refresh()->menuItems);
    }

    public function destroy(Menu $menu, MenuItem $menuItem): JsonResource
    {
        $this->authorize('delete', $menuItem);

        $menuItem->delete();

        $this->decrementSubElementOrder($menu->menuItems(), 'menu_item_id', $menuItem->menu_item_id, $menuItem->order);

        return MenuItemResource::collection($menu->refresh()->menuItems);
    }
}
