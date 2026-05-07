<?php

namespace App\Repositories;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Models\ChangeRequest;
use App\Models\User;

class ChangeRequestRepository implements ChangeRequestRepositoryInterface
{
    public function getAll()
    {
        $changeRequest = ChangeRequest::select([
            'id',
            'employee_id',
            'field_name',
            'old_value',
            'new_value',
            'status',
        ])->latest()->paginate(10);

        $changeRequest->load(['employee']);
        
        return $changeRequest;
    }

    public function getAllByUser(User $user)
    {
        $userChangeRequest = ChangeRequest::select([
            'id',
            'employee_id',
            'field_name',
            'old_value',
            'new_value',
            'status',
        ])->latest()->where('employee_id', $user->id)->paginate(10);

        $userChangeRequest->load(['employee']);
        return $userChangeRequest;
    }

    public function getNewlyData()
    {
        $newlyChangeRequest = ChangeRequest::select([
            'id',
            'employee_id',
            'field_name',
            'old_value',
            'new_value',
            'status',
        ])->latest()->limit(5)->get();

        return $newlyChangeRequest->load(['employee']);
    }

    public function getTotalPendingStatus()
    {
        $totalPendingChangeRequest = ChangeRequest::where('status', 'pending')->count();

        return $totalPendingChangeRequest;
    }

    public function create(array $attributes)
    {
        return ChangeRequest::create($attributes)->load(['employee']);
    }

    public function update(ChangeRequest $changeRequest, array $attributes)
    {
        $changeRequest->update($attributes);
        return $changeRequest->refresh()->load(['employee']);
    }
}