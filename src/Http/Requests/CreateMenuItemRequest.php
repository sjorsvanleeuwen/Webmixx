<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use SjorsvanLeeuwen\Webmixx\Models\Menu;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class CreateMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', [MenuItem::class, $this->route('menu')]);
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
                Rule::in(app(Webmixx::class)->getMenuModules()->pluck('id')),
            ],
            'link_id' => [
                'required',
                'int',
                'min:1',
            ],
        ];
    }
}
