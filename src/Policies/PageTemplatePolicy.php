<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;

class PageTemplatePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->exists;
    }

    public function view(User $user, PageTemplate $pageTemplate): bool
    {
        return $user->exists && $pageTemplate->exists;
    }

    public function create(User $user): bool
    {
        return $user->exists;
    }

    public function update(User $user, PageTemplate $pageTemplate): bool
    {
        return $user->exists && $pageTemplate->exists;
    }

    public function delete(User $user, PageTemplate $pageTemplate): bool
    {
        return $user->exists && $pageTemplate->exists;
    }
}
