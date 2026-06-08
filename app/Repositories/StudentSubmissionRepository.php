<?php

namespace App\Repositories;

use App\Contracts\StudentSubmissionRepositoryInterface;
use App\Models\StudentAssignment;
use App\Models\StudentSubmission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class StudentSubmissionRepository implements StudentSubmissionRepositoryInterface
{
    public function createSubmission(array $attributes, StudentAssignment $studentAssignment, User $user)
    {
        $submission = StudentSubmission::create([
            'assignment_id' => $studentAssignment->id,
            'student_id' => $user->detail_id,
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $submission->submissionFiles()->syncWithoutDetaching($attributes['file_uuids']);

        $submission->load(['submissionFiles', 'assignment']);

        return $submission;
    }

    public function checkIsSubmitted(StudentAssignment $studentAssignment, User $user): bool
    {
        return StudentSubmission::where('assignment_id', $studentAssignment->id)
            ->where('student_id', $user->detail_id)
            ->exists();
    }
}