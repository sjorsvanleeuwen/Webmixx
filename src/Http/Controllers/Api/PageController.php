<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Resources\PageResource;
use SjorsvanLeeuwen\Webmixx\Models\Page;

class PageController extends BaseController
{
    public function show(Page $page): JsonResource
    {
        $page->load('pageAttributes');
        return new PageResource($page);
    }
}
