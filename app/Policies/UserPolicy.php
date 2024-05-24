<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can create other users.
     */
    public function create(User $user): bool
    {
        return $user->role === 'cto';
    }

    /**
     * Determine whether the user can update the given user.
     */
    public function update(User $user, User $model): bool
    {
        return $user->role === 'cto' && $model->exists;
    }
}
