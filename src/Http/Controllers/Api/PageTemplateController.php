<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Resources\PageTemplateResource;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;

class PageTemplateController extends BaseController
{
    public function index(): JsonResource
    {
        $this->authorize('viewAny', PageTemplate::class);

        $pageTemplates = PageTemplate::with('pageAttributeTemplates')->get();

        return PageTemplateResource::collection($pageTemplates);
    }
}
