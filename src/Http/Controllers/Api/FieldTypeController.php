<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Resources\FieldTypeResource;
use SjorsvanLeeuwen\Webmixx\Http\Resources\PageModuleResource;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class FieldTypeController extends BaseController
{
    protected Webmixx $webmixx;

    public function __construct(Webmixx $webmixx)
    {
        $this->webmixx = $webmixx;
    }

    public function index(): JsonResource
    {
        $this->authorize('viewAny', PageTemplate::class);

        return FieldTypeResource::collection(FieldTypes::getIdName());
    }

    public function show(string $field_type): JsonResource
    {
        $this->authorize('viewAny', PageTemplate::class);

        $data = [];

        if ($field_type === FieldTypes::MODULE_SET) {
            $data = $this->webmixx->getPageModuleSets();
        } else if ($field_type === FieldTypes::MODULE_ITEM) {
            $data = $this->webmixx->getPageModuleItems();
        }

        return PageModuleResource::collection($data);
    }
}
