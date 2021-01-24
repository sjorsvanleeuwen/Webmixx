<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SjorsvanLeeuwen\Webmixx\Models\Page;

class CreatePageRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Page::class);
    }

    public function rules(): array
    {
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
}
