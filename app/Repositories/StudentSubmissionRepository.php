<?php

namespace App\Repositories;

use App\Contracts\StudentSubmissionRepositoryInterface;
use App\Models\StudentAssignment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class StudentSubmissionRepository implements StudentSubmissionRepositoryInterface
{
    public function getPendingSubmission(User $user)
    {
        $submissions = StudentAssignment::whereHas('classSession', function (Builder $query) use ($user) {
            $query->where('class_id', $user->class_id);
        })->whereDoesntHave('studentSubmissions', function (Builder $query) use ($user) {
            $query->where('student_id', $user->detail_id);
        })->where('submitted_at', '>', Carbon::now());
    }
}