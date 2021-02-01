<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SjorsvanLeeuwen\Webmixx\Models\Menu;

class CreateMenuRequest extends FormRequest
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
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
        ];
    }
}
