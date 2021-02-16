<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('menu_item'));
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
            'menu_item_id' => [
                'nullable',
                'int',
                Rule::exists('menu_items', 'id')
                    ->whereNot('id', $this->route('menu_item')->id),
            ],
        ];
    }
}
