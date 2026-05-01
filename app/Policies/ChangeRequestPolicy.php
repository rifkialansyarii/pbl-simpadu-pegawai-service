<?php

namespace App\Policies;

use App\Models\ChangeRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChangeRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'dosen';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ChangeRequest $changeRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'dosen';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ChangeRequest $changeRequest): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ChangeRequest $changeRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ChangeRequest $changeRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ChangeRequest $changeRequest): bool
    {
        return false;
    }

    public function viewNewly(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function viewTotalPendingStatus(User $user): bool
    {
        return $user->role === 'admin';
    }
}
