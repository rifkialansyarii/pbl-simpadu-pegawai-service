<?php

namespace App\Repositories;

use App\Contracts\GradeRepositoryInterface;
use App\Models\ClassSession;
use App\Models\Grade;
use App\Models\User;

class GradeRepository implements GradeRepositoryInterface
{
    public function getAll($classId, $courseCode)
    {
        $grades = Grade::where('class_id', $classId)->where('course_code', $courseCode)->get();

        $classSession = ClassSession::where('class_id', $classId)->first();

        $grades->transform(function ($grade) use ($classSession) {
            $grade->pengampu_id = $classSession->pengampu_id;
            return $grade;
        });

        return $grades;
    }

    public function getAllKeyByStudentIds($classId, $courseCode)
    {
        return $this->getAll($classId, $courseCode)->keyBy('student_id');
    }

    public function storeGrade(User $user, array $attributes)
    {
        $attributes['pengampu_id'] = $user->id;

        return Grade::updateOrCreate(
            [
                'class_id' => $attributes['class_id'],
                'student_id' => $attributes['student_id'],
            ],

            $attributes,
        );
    }
}