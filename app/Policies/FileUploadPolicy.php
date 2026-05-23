<?php

namespace App\Policies;

use App\Models\FileUpload;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FileUploadPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'dosen' || $user->role === 'mahasiswa';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FileUpload $fileUpload): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'dosen' || $user->role === 'mahasiswa';
    }

    public function download(User $user, FileUpload $fileUpload): bool
    {
        return ($user->role === 'dosen' || $user->role === 'mahasiswa') && $user->id === $fileUpload->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FileUpload $fileUpload): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->role === 'dosen' || $user->role === 'mahasiswa';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FileUpload $fileUpload): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FileUpload $fileUpload): bool
    {
        return false;
    }
}
