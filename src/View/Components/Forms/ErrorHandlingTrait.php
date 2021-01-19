<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\View\Components\Forms;

use Illuminate\Session\Store;
use Illuminate\Support\ViewErrorBag;

trait ErrorHandlingTrait
{
    public function hasErrors(): bool
    {
        return count($this->getErrors()) > 0;
    }

    public function getErrors(): array
    {
        $bag = $this->session()->get('errors') ?: new ViewErrorBag();

        return $bag->get($this->name);
    }

    public function stateClass(): string
    {
        if ($this->hasErrors()) {
            return 'is-invalid';
        }
        return '';
    }

    protected function hasSession(): bool
    {
        return $this->request->hasSession();
    }

    protected function session(): Store
    {
        return $this->request->session();
    }
}
