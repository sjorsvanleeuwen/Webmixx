<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class InputCheckbox extends Component
{
    use ErrorHandlingTrait;

    public string $name;

    public string $label;

    public int $value;

    public bool $checked;

    protected Request $request;

    public function __construct(Request $request, string $name, string $label, bool $checked = false)
    {
        $this->request = $request;
        $this->name = $name;
        $this->label = $label;
        $this->label = $label;
        $this->value = 1;
        $this->checked = $this->hasSession() ? $this->session()->hasOldInput($this->name) : $checked;
    }

    public function render(): View
    {
        return view('webmixx::components.forms.input-checkbox');
    }
}
