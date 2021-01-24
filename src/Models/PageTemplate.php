<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PageTemplate
 * @package SjorsvanLeeuwen\Webmixx\Models
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property bool $repeatable
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection<Page>|Page[] $pages
 * @property Collection<PageAttributeTemplate>|PageAttributeTemplate[] $pageAttributeTemplates
 * @property Collection<PageAttributeTemplate>|PageAttributeTemplate[] $rootPageAttributeTemplates
 */
class PageTemplate extends Model
{
    use HasFactory;

    /**
     * The model's attributes.
     */
    protected $attributes = [
        'repeatable' => false,
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'repeatable',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'repeatable' => 'bool',
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function pageAttributeTemplates(): HasMany
    {
        return $this->hasMany(PageAttributeTemplate::class);
    }

    public function rootPageAttributeTemplates(): HasMany
    {
        return $this->hasMany(PageAttributeTemplate::class)->whereNull('page_attribute_template_id');
    }
}
