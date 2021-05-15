<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;

class PageAttributeTemplatePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->exists;
    }

    public function view(User $user, PageAttributeTemplate $pageAttributeTemplate): bool
    {
        return $user->exists && $pageAttributeTemplate->exists;
    }

    public function create(User $user): bool
    {
        return $user->exists;
    }

    public function update(User $user, PageAttributeTemplate $pageAttributeTemplate): bool
    {
        return $user->exists && $pageAttributeTemplate->exists;
    }

    public function delete(User $user, PageAttributeTemplate $pageAttributeTemplate): bool
    {
        return $user->exists && $pageAttributeTemplate->pageAttributeTemplates->isEmpty();
    }
}
