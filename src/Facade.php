<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * @see \SjorsvanLeeuwen\Webmixx\Webmixx
 */
class Facade extends BaseFacade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'webmixx';
    }
}
