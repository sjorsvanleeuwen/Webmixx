<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SjorsvanLeeuwen\Webmixx\Contracts\Menuable;
use SjorsvanLeeuwen\Webmixx\PageAttributeBuilder;

/**
 * Class Page
 * @package SjorsvanLeeuwen\Webmixx\Models
 *
 * @property int $id
 * @property int $page_template_id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property PageTemplate $pageTemplate
 * @property Collection<PageAttribute>|PageAttribute[] $pageAttributes
 */
class Page extends Model implements Menuable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'page_template_id' => 'int',
    ];

    /**
     * @param string $key
     * @return mixed|PageAttributeBuilder
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if ($value === null) {
            // find pageAttributeTemplate
            $pageAttributeTemplate = $this
                ->pageTemplate
                ->pageAttributeTemplates
                ->where('page_attribute_template_id', null)
                ->firstWhere('slug', $key);

            $pageAttribute = $this
                ->pageAttributes
                ->whereNull('page_attribute_id')
                ->firstWhere('page_attribute_template_id', $pageAttributeTemplate->id);

            return new PageAttributeBuilder($this, $pageAttributeTemplate, $pageAttribute);
        }

        return $value;
    }

    public function pageTemplate(): BelongsTo
    {
        return $this->belongsTo(PageTemplate::class);
    }

    public function pageAttributes(): HasMany
    {
        return $this->hasMany(PageAttribute::class);
    }

    public static function moduleName(): string
    {
        return 'page';
    }
}
