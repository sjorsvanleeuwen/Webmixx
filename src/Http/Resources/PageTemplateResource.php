<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageTemplateResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'slug' => $this->resource->slug,
            'name' => $this->resource->name,
            'repeatable' => $this->resource->repeatable,
            'page_attribute_templates' => PageAttributeTemplateResource::collection($this->whenLoaded('pageAttributeTemplates')),
        ];
    }
}
