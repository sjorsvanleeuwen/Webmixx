<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SjorsvanLeeuwen\Webmixx\Models\Menu;

class CreateMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Menu::class);
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
            'link_type' => [
                'required',
                'string',
                Rule::in(app('webmixx')->getMenuModules()->pluck('id')),
            ],
            'link_id' => [
                'required',
                'int',
                'min:1',
            ],
        ];
    }
}
