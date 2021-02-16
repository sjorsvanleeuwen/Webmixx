<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;

class EditPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('page'));
    }

    public function rules(): array
    {
        $attributeRules = [];

        /** @var Page $page */
        $page = $this->route('page');

        foreach ($page->pageTemplate->rootPageAttributeTemplates as $pageAttributeTemplate) {
            $this->buildPageAttributeRules($attributeRules, $pageAttributeTemplate, 'attributes');
        }

        return [
            'name' => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
        ] + $attributeRules;
    }

    protected function buildPageAttributeRules(array &$attributeRules, PageAttributeTemplate $pageAttributeTemplate, string $base): void
    {
        if (optional($pageAttributeTemplate->pageAttributeTemplate)->repeatable) {
            $base .= '.*';
        }
        $base .= '.' . $pageAttributeTemplate->id;

        switch ($pageAttributeTemplate->field_type) {
            case FieldTypes::COMPOUND:
                $attributeRules[$base] = [
                    'required',
                    'array',
                    'min:1',
                ];
                foreach ($pageAttributeTemplate->pageAttributeTemplates as $childPageAttributeTemplate) {
                    $this->buildPageAttributeRules($attributeRules, $childPageAttributeTemplate, $base);
                }
                break;
            case FieldTypes::STRING:
                $attributeRules[$base] = [
                    'required',
                    'string',
                    'min:2',
                    'max:255',
                ];
                break;
            case FieldTypes::TEXT:
            case FieldTypes::RICH_TEXT:
                $attributeRules[$base] = [
                    'required',
                    'string',
                    'min:5',
                ];
                break;
            case FieldTypes::IMAGE:
                $attributeRules[$base] = [
                    'required',
                ];
                break;
            case FieldTypes::MODULE_SET:
                $attributeRules[$base] = [
                    'required',
                ];
                break;
        }
    }
}
