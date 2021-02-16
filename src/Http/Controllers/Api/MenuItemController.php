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
        $webmixx = app('webmixx');

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
            $this->incrementMenuItemOrderAfterAddingToNewParent($menu, $menuItem);

            $this->decrementMenuItemOrderAfterLeavingOriginalParent($menu, $original_menu_item_id, $original_order);
        } else if ($menuItem->wasChanged('order')) {
            if ($original_order < $menuItem->order) {
                $this->decrementMenuItemsAfterMovingDown($menu, $menuItem, $original_order);
            } else {
                $this->incrementMenuItemsAfterMovingUp($menu, $menuItem, $original_order);
            }
        }

        return MenuItemResource::collection($menu->refresh()->menuItems);
    }

    public function destroy(Menu $menu, MenuItem $menuItem): JsonResource
    {
        $this->authorize('delete', $menuItem);

        $menuItem->delete();

        return MenuItemResource::collection($menu->refresh()->menuItems);
    }

    protected function incrementMenuItemOrderAfterAddingToNewParent(Menu $menu, MenuItem $menuItem): void
    {
        $menu->menuItems()
            ->getQuery()
            ->where('menu_item_id', $menuItem->menu_item_id)
            ->where('order', '>=', $menuItem->order)
            ->where('id', '!=', $menuItem->id)
            ->increment('order');
    }

    protected function decrementMenuItemOrderAfterLeavingOriginalParent(Menu $menu, ?int $original_menu_item_id, int $original_order): void
    {
        $menu->menuItems()
            ->getQuery()
            ->where('menu_item_id', $original_menu_item_id)
            ->where('order', '>', $original_order)
            ->decrement('order');
    }

    protected function decrementMenuItemsAfterMovingDown(Menu $menu, MenuItem $menuItem, int $original_order): void
    {
        $menu->menuItems()
            ->getQuery()
            ->where('menu_item_id', $menuItem->menu_item_id)
            ->where('order', '>', $original_order)
            ->where('order', '<=', $menuItem->order)
            ->where('id', '!=', $menuItem->id)
            ->decrement('order');
    }

    protected function incrementMenuItemsAfterMovingUp(Menu $menu, MenuItem $menuItem, int $original_order): void
    {
        $menu->menuItems()
            ->getQuery()
            ->where('menu_item_id', $menuItem->menu_item_id)
            ->where('order', '>=', $menuItem->order)
            ->where('order', '<', $original_order)
            ->where('id', '!=', $menuItem->id)
            ->increment('order');
    }


}
