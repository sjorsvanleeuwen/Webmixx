<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Pages;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use SjorsvanLeeuwen\Webmixx\Models\PageAttribute as PageAttributeModel;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate as PageAttributeTemplateModel;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate as PageTemplateModel;

class PageAttributeTemplate extends Component
{
    public PageAttributeTemplateModel $pageAttributeTemplate;

    public PageTemplateModel $pageTemplate;

    public Collection $pageAttributes;

    public ?PageAttributeModel $pageAttribute;

    public string $baseName;

    public function __construct(PageTemplateModel $pageTemplate, PageAttributeTemplateModel $pageAttributeTemplate, Collection $pageAttributes, string $baseName = 'attributes', ?PageAttributeModel $pageAttribute = null)
    {
        $this->pageTemplate = $pageTemplate;
        $this->pageAttributeTemplate = $pageAttributeTemplate;
        $this->pageAttributes = $pageAttributes;
        $this->baseName = $baseName;
        $this->pageAttribute = $pageAttribute;
    }

    public function render(): ViewContract
    {
        return view('webmixx::components.pages.page-attribute-template');
    }

    public function ownedPageAttributes(): Collection
    {
        $attributes = $this->pageAttributes->where('page_attribute_template_id', $this->pageAttributeTemplate->id);

        if ($this->pageAttribute) {
            $attributes = $attributes->where('page_attribute_id', $this->pageAttribute->id);
        }

        return $attributes;
    }
}
