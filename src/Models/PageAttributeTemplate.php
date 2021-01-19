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
 * Class PageAttributeTemplate
 * @package SjorsvanLeeuwen\Webmixx\Models
 *
 * @property int $id
 * @property int $page_template_id
 * @property int|null $page_attribute_template_id
 * @property string $slug
 * @property string $name
 * @property string $field_type
 * @property bool $required
 * @property bool $repeatable
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property PageTemplate $pageTemplate
 * @property PageAttributeTemplate $pageAttributeTemplate
 * @property Collection<PageAttributeTemplate>|PageAttributeTemplate[] $pageAttributeTemplates
 * @property Collection<PageAttribute>|PageAttribute[] $pageAttribute
 */
class PageAttributeTemplate extends Model
{
    use HasFactory;

    /**
     * The model's attributes.
     */
    protected $attributes = [
        'repeatable' => false,
        'required' => false,
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'field_type',
        'repeatable',
        'required',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'page_template_id' => 'int',
        'page_attribute_template_id' => 'int',
        'repeatable' => 'bool',
        'required' => 'bool',
    ];

    public function pageTemplate(): BelongsTo
    {
        return $this->belongsTo(PageTemplate::class);
    }

    public function pageAttributeTemplate(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function pageAttributeTemplates(): HasMany
    {
        return $this->hasMany(self::class);
    }

    public function pageAttributes(): HasMany
    {
        return $this->hasMany(PageAttribute::class);
    }
}
