<?php

namespace App\Services;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Models\ChangeRequest;
use App\Models\User;

final class ChangeRequestService
{
    public function __construct(
        private ChangeRequestRepositoryInterface $repository
    ) {
    }

    public function getAllChangeRequest(User $user)
    {
        if ($user->role === 'admin') {
            return $this->repository->getAll();
        }

        return $this->repository->getAllByUser($user);
    }

    public function createChangeRequest(array $attributes, User $user)
    {
        $attributes['employee_id'] = $user->id;
        return $this->repository->create($attributes);
    }

    public function updateChangeRequest(ChangeRequest $changeRequest, array $attributes)
    {
        return $this->repository->update($changeRequest, $attributes);
    }

    public function getNewlyData()
    {
        return $this->repository->getNewlyData();
    }

    public function getTotalPendingStatus()
    {
        return $this->repository->getTotalPendingStatus();
    }

}