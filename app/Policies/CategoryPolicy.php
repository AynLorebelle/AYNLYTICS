<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // both system and user categories are visible
    }

    public function view(User $user, Category $category): bool
    {
        return $category->is_system || $category->user_id === $user->id || $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Category $category): bool
    {
        return $user->isAdmin() || ($category->user_id !== null && $category->user_id === $user->id);
    }

    public function delete(User $user, Category $category): bool
    {
        if ($category->is_system) {
            return $user->isAdmin();
        }
        return $user->isAdmin() || ($category->user_id !== null && $category->user_id === $user->id);
    }
}
