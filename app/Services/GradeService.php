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

    public function storeGrade(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return $this->repository->storeGrade($attributes);
        });
    }
}