<?php

namespace App\Repositories;

use App\Contracts\GradeSettingRepositoryInterface;
use App\Models\GradeSetting;
use App\Models\User;

class GradeSettingRepository implements GradeSettingRepositoryInterface
{
    public function getAllSetting(User $user)
    {
        $gradeSettings = GradeSetting::select([
            'id',
            'lecturer_id',
            'course_code',
            'course_name',
            'assignment',
            'uts',
            'uas',
        ])->where('lecturer_id', $user->detail_id)->get();

        $gradeSettings->load(['lecturer']);

        return $gradeSettings;
    }
    
    public function createSetting(array $attributes = [], User $user)
    {
        $attributes['lecturer_id'] = $user->detail_id;
        
        $gradeSetting = GradeSetting::create($attributes);

        $gradeSetting->load(['lecturer']);

        return $gradeSetting;
    }   

    public function updateSetting(array $attributes = [], User $user, GradeSetting $gradeSetting)
    {
        $attributes['lecturer_id'] = $user->detail_id;
        
        $gradeSetting->update($attributes);

        $gradeSetting->load(['lecturer']);

        return $gradeSetting;
    }   
}