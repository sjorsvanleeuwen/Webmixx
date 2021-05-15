<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageModuleResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource['id'],
            'name' => $this->resource['name'],
        ];
    }
}
