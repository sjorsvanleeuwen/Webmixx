<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Resources\LinkModelResource;
use SjorsvanLeeuwen\Webmixx\Http\Resources\LinkTypeResource;
use SjorsvanLeeuwen\Webmixx\Models\Menu;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class LinkTypeController extends BaseController
{
    protected Webmixx $webmixx;

    public function __construct(Webmixx $webmixx)
    {
        $this->webmixx = $webmixx;
    }

    public function index(): JsonResource
    {
        $this->authorize('viewAny', Menu::class);

        return LinkTypeResource::collection($this->webmixx->getMenuModules());
    }

    public function show(string $link_type): JsonResource
    {
        $menuModel = $this->webmixx->getMenuModelClass($link_type);

        $models = $menuModel::get();

        return LinkModelResource::collection($models);
    }
}
