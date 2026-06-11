<?php

namespace App\Services;

use App\Contracts\GradeSettingRepositoryInterface;
use App\Models\User;
use DB;

final class GradeSettingService
{
    public function __construct(
        private GradeSettingRepositoryInterface $repository,
    ) {
    }

    public function createSetting(array $attributes = [], User $user)
    {
        return DB::transaction(function () use ($attributes, $user) {
            return $this->repository->createSettings($attributes, $user);
        });
    }
}