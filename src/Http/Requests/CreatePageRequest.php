<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;

class CreatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Page::class);
    }

    public function rules(): array
    {
        $attributeRules = [];

        $pageTemplate = PageTemplate::with('pageAttributeTemplates')->where('id', $this->input('page_template_id'))->firstOrFail();

        foreach ($pageTemplate->rootPageAttributeTemplates as $pageAttributeTemplate) {
            $this->buildPageAttributeRules($attributeRules, $pageAttributeTemplate, 'attributes');
        }

        return [
            'name' => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
            'page_template_id' => [
                'required',
                'int',
                Rule::exists('page_templates', 'id'),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'page_template_id' => 'Page Template',
        ];
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
                    'file',
                    'image',
                    'max:3072',
                ];
        }
    }
}
