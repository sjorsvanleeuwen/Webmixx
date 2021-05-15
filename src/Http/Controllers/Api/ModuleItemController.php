<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Resources\ModuleItemListResource;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class ModuleItemController extends BaseController
{
    protected Webmixx $webmixx;

    public function __construct(Webmixx $webmixx)
    {
        $this->webmixx = $webmixx;
    }

    public function show(PageAttributeTemplate $pageAttributeTemplate): JsonResource
    {
        $this->authorize('create', Page::class);

        $dataProvider = app($pageAttributeTemplate->data_provider);

        return ModuleItemListResource::collection($dataProvider->getSelectList());
    }
}
