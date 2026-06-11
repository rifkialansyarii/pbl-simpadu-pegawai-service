<?php

namespace App\Contracts;

use App\Models\User;

interface GradeSettingRepositoryInterface
{
    public function createSettings(array $attributes = [], User $user);
}