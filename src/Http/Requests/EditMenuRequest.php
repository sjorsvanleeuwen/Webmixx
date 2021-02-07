<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('menu'));
    }

    public function rules(): array
    {
        return [
            'menu_items' => [
                'required',
                'array',
            ],
            'menu_items.*.id' => [
                'required',
                'int',
            ],
            'menu_items.*.menu_items' => [
                'nullable',
                'array',
            ],
            'menu_items.*.menu_items.*.id' => [
                'required',
                'int',
            ],
            'menu_items.*.menu_items.*.menu_items' => [
                'nullable',
                'array',
            ],
            'menu_items.*.menu_items.*.menu_items.*.id' => [
                'required',
                'int',
            ],
            'menu_items.*.menu_items.*.menu_items.*.menu_items' => [
                'nullable',
                'array',
            ],
            'menu_items.*.menu_items.*.menu_items.*.menu_items.*.id' => [
                'required',
                'int',
            ],
            'menu_items.*.menu_items.*.menu_items.*.menu_items.*.menu_items' => [
                'nullable',
                'array',
            ],
            'menu_items.*.menu_items.*.menu_items.*.menu_items.*.menu_items.*.id' => [
                'required',
                'int',
            ],
            'menu_items.*.menu_items.*.menu_items.*.menu_items.*.menu_items.*.menu_items' => [
                'nullable',
                'array',
            ],
        ];
    }
}
