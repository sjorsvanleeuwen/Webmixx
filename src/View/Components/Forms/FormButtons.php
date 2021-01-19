<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Forms;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormButtons extends Component
{
    public bool $show_cancel;

    public bool $show_save;

    public bool $show_save_and_continue;

    protected UrlGenerator $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator, bool $show_cancel = true, bool $show_save = true, bool $show_save_and_continue = false)
    {
        $this->urlGenerator = $urlGenerator;
        $this->show_cancel = $show_cancel;
        $this->show_save = $show_save;
        $this->show_save_and_continue = $show_save_and_continue;
    }

    public function render(): View
    {
        $cancelUrl = $this->urlGenerator->previous();
        return view('webmixx::components.forms.form-buttons', compact('cancelUrl'));
    }
}
