<?php

namespace App\Repositories;

use App\Contracts\StudentSubmissionRepositoryInterface;
use App\Models\StudentAssignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class StudentSubmissionRepository implements StudentSubmissionRepositoryInterface
{
    public function getNotSubmitted(User $user)
    {
        $submissions = StudentAssignment::whereHas('classSession', function (Builder $query) use ($user) {
            $query->where('class_id', $user->class_id);
        });


    }
}