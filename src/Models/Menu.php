<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Menu
 * @package SjorsvanLeeuwen\Webmixx\Models
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection<MenuItem>|MenuItem[] $menuItems
 * @property Collection<MenuItem>|MenuItem[] $rootMenuItems
 */
class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    public function rootMenuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)->whereNull('menu_item_id');
    }
}