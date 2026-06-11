<?php

namespace App\Repositories;

use App\Contracts\GradeSettingRepositoryInterface;
use App\Models\GradeSetting;
use App\Models\User;

class GradeSettingRepository implements GradeSettingRepositoryInterface
{
    public function createSettings(array $attributes = [], User $user)
    {
        $attributes['lecturer_id'] = $user->detail_id;
        
        $gradeSetting = GradeSetting::create($attributes);

        $gradeSetting->load(['lecturer']);

        return $gradeSetting;
    }   
}