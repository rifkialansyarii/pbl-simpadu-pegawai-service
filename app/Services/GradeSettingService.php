<?php

namespace App\Services;

use App\Contracts\GradeSettingRepositoryInterface;
use App\Models\GradeSetting;
use App\Models\User;
use DB;

final class GradeSettingService
{
    public function __construct(
        private GradeSettingRepositoryInterface $repository,
    ) {
    }

    public function getAllSetting(User $user){
        return $this->repository->getAllSetting($user);
    }

    public function createSetting(array $attributes = [], User $user)
    {
        return DB::transaction(function () use ($attributes, $user) {
            return $this->repository->createSetting($attributes, $user);
        });
    }

    public function updateSetting(array $attributes = [], User $user, GradeSetting $gradeSetting)
    {
        return DB::transaction(function () use ($attributes, $user, $gradeSetting) {
            return $this->repository->updateSetting($attributes, $user, $gradeSetting);
        });
    }
}