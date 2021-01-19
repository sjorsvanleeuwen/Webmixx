<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;
use SjorsvanLeeuwen\Webmixx\Models\Page;

class PagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->exists;
    }

    public function view(User $user, Page $page): bool
    {
        return $user->exists && $page->exists;
    }

    public function create(User $user): bool
    {
        return $user->exists;
    }

    public function update(User $user, Page $page): bool
    {
        return $user->exists && $page->exists;
    }

    public function delete(User $user, Page $page): bool
    {
        return $user->exists && $page->exists;
    }
}
