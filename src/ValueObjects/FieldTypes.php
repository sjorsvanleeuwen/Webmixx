<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\ValueObjects;

use Illuminate\Support\Collection;

class FieldTypes
{
    public const IMAGE = 'image';

    public const STRING = 'string';

    public const TEXT = 'text';

    public const RICH_TEXT = 'rich_text';

    public const COMPOUND = 'compound';

    /**
     * @return string[]
     */
    public static function getAllTypes(): array
    {
        return [
            self::STRING,
            self::TEXT,
            self::RICH_TEXT,
            self::IMAGE,
            self::COMPOUND,
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
            self::COMPOUND => 'Compound',
        ]);
    }
}
