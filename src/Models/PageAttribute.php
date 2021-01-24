<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PageAttribute
 * @package SjorsvanLeeuwen\Webmixx\Models
 *
 * @property int $id
 * @property int $page_id
 * @property int $page_attribute_template_id
 * @property int $page_attribute_id
 * @property mixed $value
 * @property int $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Page $page
 * @property PageAttributeTemplate $pageAttributeTemplate
 * @property PageAttribute $pageAttribute
 * @property Collection<PageAttribute>|PageAttribute[] $pageAttributes
 */
class PageAttribute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'value',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'page_id' => 'int',
        'page_attribute_template_id' => 'int',
        'page_attribute_id' => 'int',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function pageAttributeTemplate(): BelongsTo
    {
        return $this->belongsTo(PageAttributeTemplate::class);
    }

    public function pageAttribute(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function pageAttributes(): HasMany
    {
        return $this->hasMany(self::class);
    }
}
