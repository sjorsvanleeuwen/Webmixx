<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;

class CreatePageTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', PageTemplate::class);
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
            'repeatable' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'repeatable' => 'Repeatable',
        ];
    }
}
