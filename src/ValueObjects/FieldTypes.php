<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\ValueObjects;

use Illuminate\Support\Collection;

class FieldTypes
{
    public const COMPOUND = 'compound';

    public const IMAGE = 'image';

    public const MODULE_ITEM = 'module_item';

    public const MODULE_SET = 'module_set';

    public const RICH_TEXT = 'rich_text';

    public const STRING = 'string';

    public const TEXT = 'text';

    /**
     * @return string[]
     */
    public static function getAllTypes(): array
    {
        return [
            self::COMPOUND,
            self::IMAGE,
            self::MODULE_ITEM,
            self::MODULE_SET,
            self::RICH_TEXT,
            self::STRING,
            self::TEXT,
        ];
    }

    /**
     * @return Collection<string, string>
     */
    public static function getAll(): Collection
    {
        return collect([
            self::STRING => 'String',
            self::TEXT => 'Text',
            self::RICH_TEXT => 'Rich Text',
            self::IMAGE => 'Image',
            self::MODULE_ITEM => 'Module Item',
            self::MODULE_SET => 'Module Set',
            self::COMPOUND => 'Compound',
        ]);
    }
}
