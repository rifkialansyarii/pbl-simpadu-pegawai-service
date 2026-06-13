<?php

namespace App\Policies;

use App\Models\GradeSetting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GradeSettingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'dosen';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GradeSetting $gradeSetting): bool
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
    public function update(User $user, GradeSetting $gradeSetting): bool
    {
        return $user->role === 'dosen' && $user->detail_id === $gradeSetting->lecturer_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GradeSetting $gradeSetting): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GradeSetting $gradeSetting): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GradeSetting $gradeSetting): bool
    {
        return false;
    }
}
