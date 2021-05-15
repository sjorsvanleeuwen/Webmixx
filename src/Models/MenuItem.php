<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class MenuItem
 * @package SjorsvanLeeuwen\Webmixx\Models
 *
 * @property int $id
 * @property int $menu_id
 * @property ?int $menu_item_id
 * @property string $link_type
 * @property int $link_id
 * @property string $slug
 * @property string $name
 * @property string $full_slug
 * @property int $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Model $link
 * @property Menu $menu
 * @property MenuItem $menuItem
 * @property Collection<MenuItem>|MenuItem[] $menuItems
 */
class MenuItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
    ];

    public function link(): MorphTo
    {
        return $this->morphTo();
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(self::class)->orderBy('order');
    }

    public function url(): string
    {
        if ($this->menu_item_id === null && $this->order === 0) {
            return '';
        }
        return $this->full_slug;
    }
}
