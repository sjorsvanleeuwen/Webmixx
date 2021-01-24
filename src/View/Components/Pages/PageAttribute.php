<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Pages;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate as PageAttributeTemplateModel;
use SjorsvanLeeuwen\Webmixx\Models\PageAttribute as PageAttributeModel;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate as PageTemplateModel;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;

class PageAttribute extends Component
{
    public string $key;
    public PageTemplateModel $pageTemplate;
    public PageAttributeTemplateModel $pageAttributeTemplate;
    public Collection $pageAttributes;
    public ?PageAttributeModel $pageAttribute;
    public string $baseName;

    public function __construct(PageTemplateModel $pageTemplate, PageAttributeTemplateModel $pageAttributeTemplate, Collection $pageAttributes, string $baseName, ?PageAttributeModel $pageAttribute = null)
    {
        $this->key = Str::random();
        $this->pageTemplate = $pageTemplate;
        $this->pageAttributeTemplate = $pageAttributeTemplate;
        $this->pageAttributes = $pageAttributes;
        $this->baseName = $baseName;
        $this->pageAttribute = $pageAttribute;
    }

    public function render(): ViewContract
    {
        return view('webmixx::components.pages.page-attribute');
    }

    public function getFieldTypeClass(): string
    {
        return $this->pageAttributeTemplate->field_type;
    }

    public function hasChildAttributes(): bool
    {
        return $this->pageAttributeTemplate->field_type === FieldTypes::COMPOUND;
    }

    public function getChildPageAttributeTemplates(): Collection
    {
        return $this->pageTemplate->pageAttributeTemplates->where('page_attribute_template_id', $this->pageAttributeTemplate->id);
    }

    public function getFieldTypeComponent(): string
    {
        return 'webmixx-forms:input-text';
    }

    public function getValue(): ?string
    {
        if ($this->pageAttribute !== null) {
            return $this->pageAttribute->value;
        }

        return null;
    }

    public function getFieldName(): string
    {
        if ($this->pageAttributeTemplate->repeatable) {
            return $this->baseName . '[' . $this->pageAttributeTemplate->id . '][' . $this->key . ']';
        }
        return $this->baseName . '[' . $this->pageAttributeTemplate->id . ']';
    }
}
