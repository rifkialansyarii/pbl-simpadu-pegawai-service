<?php

namespace App\Repositories;

use App\Contracts\StudentSubmissionRepositoryInterface;
use App\Models\ClassSession;
use App\Models\StudentAssignment;
use App\Models\StudentSubmission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class StudentSubmissionRepository implements StudentSubmissionRepositoryInterface
{

    public function getAllSubmission(StudentAssignment $studentAssignment)
    {
        $submission = StudentSubmission::where('assignment_id', $studentAssignment->id)->get();
        $submission->load('submissionFiles');
        return $submission;
    }

    public function addScore(array $attributes)
    {
        $submission = StudentSubmission::where('student_id', $attributes['student_id'])
            ->where('assignment_id', $attributes['assignment_id'])
            ->first();
        if ($submission->count() !== 0) {
            $submission->update([
                'score' => $attributes['score']
            ]);

            return $submission;
        } else {
            return StudentSubmission::create([
                'student_id' => $attributes['student_id'],
                'assignment_id' => $attributes['assignment_id'],
                'score' => $attributes['score'],
                'submitted_at' => null,
            ]);
        }
    }

    public function generateSubmission(array $attributes, StudentAssignment $studentAssignment)
    {
        $submission = $studentAssignment->studentSubmissions()->createMany($attributes["students"]);

        $submission->load(['submissionFiles', 'assignment']);

        return $submission;
    }

    public function updateSubmission(array $attributes, StudentAssignment $studentAssignment, User $user)
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

    public function deleteSubmission(StudentAssignment $studentAssignment, User $user)
    {
        StudentSubmission::where('assignment_id', $studentAssignment->id)->where('student_id', $user->detail_id)->delete();
    }
}