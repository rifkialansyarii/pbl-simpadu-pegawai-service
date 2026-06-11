<?php

namespace App\Contracts;

use App\Models\User;

interface GradeSettingRepositoryInterface
{   
    public function getAllSetting(User $user);
    public function createSetting(array $attributes = [], User $user);
}