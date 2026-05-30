<?php

namespace App\Policies;

use App\Models\ClassSession;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassSessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin-pegawai' || $user->role === 'super-admin' || $user->role === 'dosen' || $user->role === 'mahasiswa';

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ClassSession $classSession): bool
    {
        return $user->role === 'admin-pegawai' || $user->role === 'super-admin' || ($user->role === 'dosen' && $classSession->lecturer_id === $user->id) || ($user->role === 'mahasiswa' && $user->class_id === $classSession->class_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function generate(User $user): bool
    {
        return $user->role === 'admin-pegawai' || $user->role === 'super-admin';

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ClassSession $classSession): bool
    {
        return $user->role === 'admin-pegawai' || $user->role === 'super-admin' || ($user->role === 'dosen' && $classSession->lecturer_id === $user->detail_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function bulkDelete(User $user): bool
    {
        return $user->role === 'admin-pegawai' || $user->role === 'super-admin';
    }

    public function createMaterial(User $user, ClassSession $classSession)
    {
        return $user->role === 'dosen' && $classSession->lecturer_id === $user->detail_id;
    }

    public function deleteMaterial(User $user, ClassSession $classSession)
    {
        return $user->role === 'dosen' && $classSession->lecturer_id === $user->detail_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ClassSession $classSession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ClassSession $classSession): bool
    {
        return false;
    }
}
