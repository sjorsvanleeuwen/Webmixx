<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Forms;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class MultiSelect extends Component
{
    use ErrorHandlingTrait;

    public string $name;

    public string $label;

    public array $options;

    public array $values;

    protected Request $request;

    public function __construct(Request $request, string $name, string $label, array $options, array $values = [])
    {
        $this->request = $request;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->values = (array)$this->request->old($this->name, $values);
    }

    public function render(): ViewContract
    {
        return view('webmixx::components.forms.multi-select');
    }

    public function isSelected(string $option_value): bool
    {
        return in_array($option_value, $this->values, false);
    }
}
