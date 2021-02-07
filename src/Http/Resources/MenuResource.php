<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Models\Menu;

/**
 * Class MenuResource
 * @package SjorsvanLeeuwen\Webmixx\Http\Resources
 *
 * @property Menu $resource
 */
class MenuResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'slug' => $this->resource->slug,
            'name' => $this->resource->name,
            'menu_items' => MenuItemResource::collection($this->whenLoaded('menuItems')),
        ];
    }
}
