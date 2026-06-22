<?php

namespace App\Services;

use App\Contracts\GradeRepositoryInterface;
use App\Models\Grade;
use App\Models\User;
use DB;

final class GradeService
{
    public function __construct(
        private GradeRepositoryInterface $repository,
    ) {
    }

    public function getAll($classId, $courseCode)
    {
        return $this->repository->getAll($classId, $courseCode);
    }

    public function encrichedStudents(array $students, $existingGrades, $existingSubmissions)
    {
        return collect($students)->map((function ($student) use ($existingGrades, $existingSubmissions) {
            $studentId = $student['student_id'];

            $student['assignment_scores'] = [];

            if (isset($existingSubmissions[$studentId])) {
                foreach ($existingSubmissions[$studentId] as $submission) {
                    $student['assignment_scores'][$submission->assignment_id] = $submission->score;
                }
            }

            if (isset($existingGrades[$studentId])) {
                $student['uts_score'] = $existingGrades[$studentId]->uts; // Sesuaikan nama field di tabelmu
                $student['uas_score'] = $existingGrades[$studentId]->uas; // Sesuaikan nama field di tabelmu
            } else {
                $student['uts_score'] = '';
                $student['uas_score'] = '';
            }

            return $student;
        }))->toArray();
    }

    public function getExistingGrade($classId, $courseCode)
    {
        return $this->repository->getAllKeyByStudentIds($classId, $courseCode);
    }

    public function storeGrade(User $user, array $attributes)
    {
        return DB::transaction(function () use ($user, $attributes) {
            return $this->repository->storeGrade($user, $attributes);
        });
    }
}