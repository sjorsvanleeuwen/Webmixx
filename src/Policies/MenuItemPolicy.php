<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use SjorsvanLeeuwen\Webmixx\Models\Menu;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;

class MenuItemPolicy
{
    use HandlesAuthorization;

    public function view(?User $user, MenuItem $menuItem): bool
    {
        return true;
    }

    public function create(User $user, Menu $menu): bool
    {
        return $user->can('create', $menu);
    }

    public function update(User $user, MenuItem $menuItem): bool
    {
        return $user->exists && $menuItem->exists;
    }

    public function delete(User $user, MenuItem $menuItem): bool
    {
        return $user->exists && $menuItem->menuItems()->count() === 0;
    }
}
