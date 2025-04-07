<?php

use App\Policies;

class UserPolicy
{
    public function view(User $authUser, User $targetUser)
    {
        // Allow viewing only if it's the same user or if the auth user is admin
        return $authUser->id === $targetUser->id || $authUser->is_admin;
    }

    public function viewAll(User $authUser, User $targetUser)
    {
        // Allow viewing only if it's the same user or if the auth user is admin
        return $authUser->is_admin;
    }

    public function update(User $authUser, User $targetUser)
    {
        return $authUser->id === $targetUser->id;
    }

    public function delete(User $authUser, User $targetUser)
    {
        return $authUser->is_admin && $authUser->id !== $targetUser->id;
    }
}
