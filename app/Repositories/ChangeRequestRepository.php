<?php

namespace App\Repositories;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Models\ChangeRequest;
use App\Models\User;

class ChangeRequestRepository implements ChangeRequestRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $changeRequest = ChangeRequest::select([
            'id',
            'employee_id',
            'field_name',
            'old_value',
            'new_value',
            'status',
        ]);

        $changeRequest = $this->filterData($filters, $changeRequest);

        $changeRequest = $changeRequest->latest()->paginate(10);

        $changeRequest->load(['employee']);

        return $changeRequest;
    }

    public function getAllByUser(User $user, array $filters = [])
    {
        $userChangeRequest = ChangeRequest::select([
            'id',
            'employee_id',
            'field_name',
            'old_value',
            'new_value',
            'status',
        ])->where('employee_id', $user->detail_id);

        $userChangeRequest = $this->filterData($filters, $userChangeRequest);
        
        $userChangeRequest = $userChangeRequest->latest()->paginate(10);

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

    public function filterData(array $filters = [], $changeRequest){

        if(isset($filters['status'])){
            $changeRequest->where('status', $filters['status']);
        }
        return $changeRequest;
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