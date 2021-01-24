<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageAttributeResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'page_id' => $this->resource->page_id,
            'page_attribute_template_id' => $this->resource->page_attribute_template_id,
            'page_attribute_id' => $this->resource->page_attribute_id,
            'value' => $this->resource->value,
            'order' => $this->resource->order,
            'page' => new PageTemplateResource($this->whenLoaded('page')),
            'page_attribute_template' => new PageAttributeTemplateResource($this->whenLoaded('pageAttributeTemplate')),
            'page_attribute' => new PageAttributeResource($this->whenLoaded('pageAttribute')),
            'page_attributes' => PageAttributeResource::collection($this->whenLoaded('pageAttributes')),
        ];
    }
}
