<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Resources\PageTemplateResource;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;

class PageTemplateController extends BaseController
{
    public function index(): JsonResource
    {
        $this->authorize('viewAny', PageTemplate::class);

        $pageTemplateSearchQuery = PageTemplate::query()
            ->with('pageAttributeTemplates');

        if (request()->has('exclude_page_id')) {
            $pageTemplateSearchQuery->where(function (Builder $query) {
                $query->where('repeatable', true)
                    ->orWhereDoesntHave('pages', function (Builder $query) {
                        $query->where('pages.id', '!=', request()->get('exclude_page_id'));
                    });
            });
        } else {
            $pageTemplateSearchQuery->where(function (Builder $query) {
                $query->where('repeatable', true)
                    ->orWhereDoesntHave('pages');
            });
        }


        $pageTemplates = $pageTemplateSearchQuery->get();

        return PageTemplateResource::collection($pageTemplates);
    }

    public function show(PageTemplate $pageTemplate): JsonResource
    {
        $this->authorize('view', $pageTemplate);

        $pageTemplate->load('pageAttributeTemplates');

        return new PageTemplateResource($pageTemplate);
    }
}
