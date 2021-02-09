<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx;

use Illuminate\Support\Collection;
use IteratorAggregate;
use SjorsvanLeeuwen\Webmixx\Exceptions\PageAttributeTemplateNotFoundException;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageAttribute;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;

class PageAttributeBuilder implements IteratorAggregate
{
    protected Page $page;

    protected PageAttributeTemplate $pageAttributeTemplate;

    protected ?PageAttribute $pageAttribute;

    public function __construct(Page $page, PageAttributeTemplate $pageAttributeTemplate, ?PageAttribute $pageAttribute = null)
    {
        $this->page = $page;
        $this->pageAttributeTemplate = $pageAttributeTemplate;
        $this->pageAttribute = $pageAttribute;
    }

    /**
     * @return PageAttributeBuilder|PageAttributeBuilder[]
     */
    public function __get(string $name): self
    {
        $pageAttributeTemplate = $this
            ->page
            ->pageTemplate
            ->pageAttributeTemplates
            ->where('slug', $name)
            ->where('page_attribute_template_id', optional($this->pageAttributeTemplate)->id)
            ->first();

        if ($pageAttributeTemplate === null) {
            throw (new PageAttributeTemplateNotFoundException())->setSlug($name, optional($this->pageAttributeTemplate)->slug);
        }

        return new self($this->page, $pageAttributeTemplate, $this->getChildPageAttribute($pageAttributeTemplate));
    }

    public function __toString(): string
    {
        if ($this->pageAttribute === null) {
            return '';
        }
        return $this->pageAttribute->value;
    }

    public function getIterator(): Collection
    {
        if ($this->pageAttributeTemplate->repeatable) {
            return $this->iteratorRepeatable();
        } elseif ($this->pageAttributeTemplate->field_type === FieldTypes::MODULE_SET) {
            return $this->iteratorModuleSet();
        }
        return collect([1,2,3]);
    }

    protected function getChildPageAttribute(PageAttributeTemplate $pageAttributeTemplate): PageAttribute
    {
        return $this
            ->page
            ->pageAttributes
            ->where('page_attribute_template_id', $pageAttributeTemplate->id)
            ->firstWhere('page_attribute_id', optional($this->pageAttribute)->id);
    }

    protected function iteratorRepeatable(): Collection
    {
        $attributes = $this
            ->page
            ->pageAttributes
            ->where('page_attribute_template_id', $this->pageAttributeTemplate->id)
            ->where('page_attribute_id', optional($this->pageAttribute)->page_attribute_id);

        $collection = new Collection();

        foreach ($attributes as $attribute) {
            $collection->push(new self($this->page, $this->pageAttributeTemplate, $attribute));
        }

        return $collection;
    }

    protected function iteratorModuleSet(): Collection
    {
        $dataProvider = new $this->pageAttributeTemplate->data_provider;

        return $dataProvider->getIterator();
    }
}
