<?php

namespace App\Contracts;

use App\Models\GradeSetting;
use App\Models\User;

interface GradeSettingRepositoryInterface
{   
    public function getAllSetting(User $user);
    public function getByField(array $field);
    public function createSetting(array $attributes = [], User $user);
    public function updateSetting(array $attributes = [], User $user, GradeSetting $gradeSetting);
}