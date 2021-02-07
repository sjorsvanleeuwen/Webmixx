<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreateMenuItemRequest;
use SjorsvanLeeuwen\Webmixx\Http\Resources\MenuItemResource;
use SjorsvanLeeuwen\Webmixx\Models\Menu;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class MenuItemController extends BaseController
{
    public function store(CreateMenuItemRequest $request, Menu $menu): JsonResource
    {
        $this->authorize('create', $menu);

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
}
