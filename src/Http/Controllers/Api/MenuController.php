<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Resources\MenuResource;
use SjorsvanLeeuwen\Webmixx\Models\Menu;

class MenuController extends BaseController
{
    public function show(Menu $menu): JsonResource
    {
        $this->authorize('view', $menu);

        $menu->load('menuItems');

        return new MenuResource($menu);
    }
}
