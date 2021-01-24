<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'page_template_id' => $this->resource->page_template_id,
            'name' => $this->resource->name,
            'page_template' => new PageTemplateResource($this->whenLoaded('pageTemplate')),
            'page_attributes' => PageAttributeResource::collection($this->whenLoaded('pageAttributes')),
        ];
    }
}
