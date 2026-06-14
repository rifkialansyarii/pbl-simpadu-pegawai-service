<?php

namespace App\Services;

use App\Contracts\StudentAssignmentRepositoryInterface;
use App\Models\ClassSession;
use App\Models\User;
use DB;
use Exception;

final class StudentAssignmentService
{
    public function __construct(
        private StudentAssignmentRepositoryInterface $repository,
    ) {
    }

    public function getPendingSubmission(User $user)
    {
        return $this->repository->getPendingSubmission($user);
    }

    public function addStudentAssignment(ClassSession $classSession, array $attributes)
    {
        return DB::transaction(function () use ($classSession, $attributes) {
            return $this->repository->createStudentAssignment($classSession, $attributes);
            ;
        });
    }

    public function deleteStudentAssignment(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return $this->repository->deleteStudentAssignment($attributes);
        });
    }

}