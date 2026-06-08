<?php

namespace App\Services;

use App\Contracts\StudentSubmissionRepositoryInterface;
use App\Models\StudentAssignment;
use App\Models\User;
use DB;
use Exception;
use Throwable;

final class StudentSubmissionService
{
    public function __construct(
        private StudentSubmissionRepositoryInterface $repository,
    ) {
    }

    public function createSubmission(array $attributes, StudentAssignment $studentAssignment, User $user)
    {
        return DB::transaction(function () use ($attributes, $studentAssignment, $user) {

            if (!$this->repository->checkIsSubmitted($studentAssignment, $user)) {
                return $this->repository->createSubmission($attributes, $studentAssignment, $user);
            } else {
                throw new Exception("data has been created");

            }

        });
    }
}