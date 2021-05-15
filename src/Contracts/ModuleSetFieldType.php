<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Contracts;

use Traversable;

interface ModuleSetFieldType extends ModuleFieldType
{
    public function getIterator(): Traversable;
}
