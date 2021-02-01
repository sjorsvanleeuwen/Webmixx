<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;
use SjorsvanLeeuwen\Webmixx\Models\Menu;

class MenuPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->exists;
    }

    public function view(User $user, Menu $menu): bool
    {
        return $user->exists && $menu->exists;
    }

    public function create(User $user): bool
    {
        return $user->exists;
    }

    public function update(User $user, Menu $menu): bool
    {
        return $user->exists && $menu->exists;
    }

    public function delete(User $user, Menu $menu): bool
    {
        return $user->exists && $menu->exists;
    }
}
