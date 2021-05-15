<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ModuleItemFieldType extends ModuleFieldType
{
    public static function getSelectList(): Collection;

    public function getItem(int $value): Model;
}
