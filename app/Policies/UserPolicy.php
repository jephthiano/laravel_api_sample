<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAll(User $authUser)
    {
        // Allow viewing only if the auth user is admin
        return $authUser->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $authUser, User $targetUser)
    {
        // Allow viewing only if it's the same user or if the auth user is admin
        return $authUser->id === $targetUser->id || $authUser->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser, User $targetUser)
    {
        // Allow updateing only if it's the same user
        return $authUser->id === $targetUser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $authUser, User $targetUser)
    {
        // Allow deleting only if it's the same user or if the auth user is admin
        return $authUser->id === $targetUser->id || $authUser->is_admin;
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, User $model): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, User $model): bool
    // {
    //     return false;
    // }
}
