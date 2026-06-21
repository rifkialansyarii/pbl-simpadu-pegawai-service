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

    public function storeGrade(User $user, array $attributes)
    {
        return DB::transaction(function () use ($user, $attributes) {
            return $this->repository->storeGrade($user,$attributes);
        });
    }
}