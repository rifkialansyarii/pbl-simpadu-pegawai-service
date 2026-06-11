<?php

namespace App\Services;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Models\ChangeRequest;
use App\Models\Employee;
use App\Models\User;

final class ChangeRequestService
{
    public function __construct(
        private ChangeRequestRepositoryInterface $repository
    ) {
    }

    public function getAllChangeRequest(User $user, array $filters = [])
    {
        if ($user->role === 'admin-pegawai') {
            return $this->repository->getAll($filters);
        }

        return $this->repository->getAllByUser($user, $filters);
    }

    public function updateChangeRequest(ChangeRequest $changeRequest, array $attributes)
    {
        if($attributes['status'] === 'approved')
        {
            $employee = Employee::find($changeRequest->employee_id);
            $employee->update([
                $changeRequest->field_name => $changeRequest->new_value,
            ]);
        }

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