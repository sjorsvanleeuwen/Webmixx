<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Forms;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class InputText extends Component
{
    use ErrorHandlingTrait;

    public string $name;

    public string $label;

    public ?string $value;

    protected Request $request;

    public function __construct(Request $request, string $name, string $label, ?string $value = null)
    {
        $this->request = $request;
        $this->name = $name;
        $this->label = $label;
        $this->value = strval($this->request->old($this->name, $value));
    }

    public function render(): ViewContract
    {
        return view('webmixx::components.forms.input-text');
    }
}
