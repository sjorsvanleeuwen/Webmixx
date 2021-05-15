<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditPageAttributeTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('page_attribute_template'));
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'order' => [
                'required',
                'int',
                'min:0',
            ],
            'page_attribute_template_id' => [
                'nullable',
                'int',
                Rule::exists('page_attribute_templates', 'id')
                    ->whereNot('id', $this->route('page_attribute_template')->id),
            ],
        ];
    }
}
