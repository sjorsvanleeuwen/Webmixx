<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Exceptions;

use RuntimeException;

class PageAttributeTemplateNotFoundException extends RuntimeException
{
    protected string $page_attribute_template_slug;

    protected ?string $parent_page_attribute_template_slug;

    public function setSlug(string $slug, ?string $in_slug = null): self
    {
        $this->page_attribute_template_slug = $slug;
        $this->parent_page_attribute_template_slug = $in_slug;

        $this->message = 'No page_attribute_template found for slug [' . $this->page_attribute_template_slug . ']';

        if ($this->parent_page_attribute_template_slug) {
            $this->message .= ' in [' . $this->parent_page_attribute_template_slug . ']';
        } else {
            $this->message .= ' in root';
        }

        return $this;
    }
}
