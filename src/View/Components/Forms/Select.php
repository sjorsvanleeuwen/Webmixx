<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Select extends Component
{
    use ErrorHandlingTrait;

    public string $name;

    public string $label;

    public array $options;

    public ?string $value;

    public bool $emptyFirst;

    public bool $allowEmpty;

    protected Request $request;

    public function __construct(Request $request, string $name, string $label, array $options, ?string $value = null, bool $emptyFirst = false, bool $allowEmpty = false)
    {
        $this->request = $request;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->value = strval($this->request->old($this->name, $value));
        $this->emptyFirst = $emptyFirst;
        $this->allowEmpty = $allowEmpty;
    }

    public function render(): View
    {
        return view('webmixx::components.forms.select');
    }

    public function isSelected(string $option_value): bool
    {
        return $this->value === $option_value;
    }
}
