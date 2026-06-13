<?php

namespace App\Repositories;

use App\Contracts\GradeRepositoryInterface;
use App\Models\Grade;
use App\Models\User;

class GradeRepository implements GradeRepositoryInterface
{
    public function storeGrade(array $attributes)
    {
        return Grade::updateOrCreate(
            [
                'class_id' => $attributes['class_id'],
                'student_id' => $attributes['student_id'],
            ],

            $attributes,
        );
    }
}