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
            'name' => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
            'repeatable' => [
                'nullable',
                'boolean',
            ],
            'field_type' => [
                'required',
                'string',
                Rule::in(FieldTypes::getAllTypes()),
            ],
            'data_provider' => [
                Rule::requiredIf(in_array($this->input('field_type'), [
                    FieldTypes::MODULE_ITEM,
                    FieldTypes::MODULE_SET,
                ], true)),
                'nullable',
                'string',
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'page_template_id' => 'Page Template',
            'name' => 'Name',
            'field_type' => 'Field Type',
            'repeatable' => 'Repeatable',
            'data_provider' => 'Data provider',
        ];
    }
}
