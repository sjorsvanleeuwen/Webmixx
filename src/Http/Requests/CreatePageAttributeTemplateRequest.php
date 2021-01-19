<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes;

class CreatePageAttributeTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', PageAttributeTemplate::class);
    }

    public function rules(): array
    {
        return [
            'page_template_id' => [
                'required',
                'int',
                Rule::exists('page_templates', 'id'),
            ],
            'page_attribute_template_id' => [
                'nullable',
                'int',
                Rule::exists('page_attribute_templates', 'id'),
            ],
            'name' => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
            'field_type' => [
                'required',
                'string',
                Rule::in(FieldTypes::getAllTypes()),
            ],
            'required' => [
                'nullable',
                'boolean',
            ],
            'repeatable' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'page_template_id' => 'Page Template',
            'name' => 'Name',
            'field_type' => 'Field Type',
            'required' => 'Required',
            'repeatable' => 'Repeatable',
        ];
    }
}
