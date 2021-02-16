<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageAttributeTemplateResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'page_template_id' => $this->resource->page_template_id,
            'page_attribute_template_id' => $this->resource->page_attribute_template_id,
            'slug' => $this->resource->slug,
            'name' => $this->resource->name,
            'field_type' => $this->resource->field_type,
            'repeatable' => $this->resource->repeatable,
            'order' => $this->resource->order,
            'data_provider' => $this->resource->data_provider,
            'page_template' => new PageTemplateResource($this->whenLoaded('pageTemplate')),
        ];
    }
}
