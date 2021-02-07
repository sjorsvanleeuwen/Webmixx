<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;

/**
 * Class MenuItemResource
 * @package SjorsvanLeeuwen\Webmixx\Http\Resources
 *
 * @property MenuItem $resource
 */
class MenuItemResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'menu_id' => $this->resource->menu_id,
            'menu_item_id' => $this->resource->menu_item_id,
            'link_type' => $this->resource->link_type,
            'link_id' => $this->resource->link_id,
            'slug' => $this->resource->slug,
            'name' => $this->resource->name,
            'full_slug' => $this->resource->full_slug,
            'order' => $this->resource->order,
            'menu' => new MenuResource($this->whenLoaded('menu')),
            'menu_item' => new self($this->whenLoaded('menu_item')),
            'menu_items' => self::collection($this->resource->menuItems),
        ];
    }
}
