<?php

namespace App\Services;

use App\Contracts\StudentAssignmentRepositoryInterface;
use App\Contracts\StudentSubmissionRepositoryInterface;
use App\Models\ClassSession;
use App\Models\User;
use DB;

final class StudentSubmissionService
{
    public function __construct(
        private StudentSubmissionRepositoryInterface $repository,
    ) {
    }

    public function getNotSubmitted(User $user)
    {
        return $this->repository->getNotSubmitted($user);
    }
}