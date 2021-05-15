<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreatePageAttributeTemplateRequest;
use SjorsvanLeeuwen\Webmixx\Http\Requests\EditPageAttributeTemplateRequest;
use SjorsvanLeeuwen\Webmixx\Http\Resources\PageAttributeTemplateResource;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;

class PageAttributeTemplateController extends BaseController
{
    public function store(CreatePageAttributeTemplateRequest $request, PageTemplate $pageTemplate): JsonResource
    {
        $this->authorize('create', PageAttributeTemplate::class);

        $data = $request->validated();

        /** @var PageAttributeTemplate $pageAttributeTemplate */
        $pageAttributeTemplate = $pageTemplate->pageAttributeTemplates()->make();
        $pageAttributeTemplate->name = $data['name'];
        $pageAttributeTemplate->slug = Str::slug($pageAttributeTemplate->name, '_');
        $pageAttributeTemplate->repeatable = $request->boolean('repeatable');
        $pageAttributeTemplate->field_type = $data['field_type'];
        $pageAttributeTemplate->data_provider = Arr::get($data, 'data_provider');
        $pageAttributeTemplate->order = $pageTemplate->rootPageAttributeTemplates->count();
        $pageAttributeTemplate->save();

        return new PageAttributeTemplateResource($pageAttributeTemplate);
    }

    public function update(EditPageAttributeTemplateRequest $request, PageTemplate $pageTemplate, PageAttributeTemplate $pageAttributeTemplate): JsonResource
    {
        $this->authorize('update', $pageAttributeTemplate);

        $original_page_attribute_template_id = $pageAttributeTemplate->page_attribute_template_id;
        $original_order = $pageAttributeTemplate->order;

        $pageAttributeTemplate->page_attribute_template_id = $request->input('page_attribute_template_id');
        $pageAttributeTemplate->name = $request->input('name');
        $pageAttributeTemplate->slug = Str::slug($pageAttributeTemplate->name, '_');
        $pageAttributeTemplate->order = $request->input('order');

        $pageAttributeTemplate->save();

        if ($pageAttributeTemplate->wasChanged('page_attribute_template_id')) {
            $this->incrementSubElementOrder($pageTemplate->pageAttributeTemplates(), 'page_attribute_template_id', $pageAttributeTemplate->page_attribute_template_id, $pageAttributeTemplate->order, null, $pageAttributeTemplate->id);

            $this->decrementSubElementOrder($pageTemplate->pageAttributeTemplates(), 'page_attribute_template_id', $original_page_attribute_template_id, $original_order);
        } else if ($pageAttributeTemplate->wasChanged('order')) {
            if ($original_order < $pageAttributeTemplate->order) {
                $this->decrementSubElementOrder($pageTemplate->pageAttributeTemplates(), 'page_attribute_template_id', $pageAttributeTemplate->page_attribute_template_id, $original_order, $pageAttributeTemplate->order, $pageAttributeTemplate->id);
            } else {
                $this->incrementSubElementOrder($pageTemplate->pageAttributeTemplates(), 'page_attribute_template_id', $pageAttributeTemplate->page_attribute_template_id, $pageAttributeTemplate->order, $original_order, $pageAttributeTemplate->id);
            }
        }

        return PageAttributeTemplateResource::collection($pageTemplate->refresh()->pageAttributeTemplates);
    }

    public function destroy(PageTemplate $pageTemplate, PageAttributeTemplate $pageAttributeTemplate): JsonResource
    {
        $this->authorize('delete', $pageAttributeTemplate);

        $pageAttributeTemplate->pageAttributes()->delete();
        $pageAttributeTemplate->delete();

        $this->decrementSubElementOrder($pageTemplate->pageAttributeTemplates(), 'page_attribute_template_id', $pageAttributeTemplate->page_attribute_template_id, $pageAttributeTemplate->order);

        return PageAttributeTemplateResource::collection($pageTemplate->refresh()->pageAttributeTemplates);
    }
}
