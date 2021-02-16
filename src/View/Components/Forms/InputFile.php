<?php


namespace SjorsvanLeeuwen\Webmixx\View\Components\Forms;


use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class InputFile extends Component
{
    use ErrorHandlingTrait;

    public string $name;

    public string $label;

    protected Request $request;

    public function __construct(Request $request, string $name, string $label)
    {
        $this->request = $request;
        $this->name = $name;
        $this->label = $label;
    }

    public function render(): ViewContract
    {
        return view('webmixx::components.forms.input-file');
    }
}
