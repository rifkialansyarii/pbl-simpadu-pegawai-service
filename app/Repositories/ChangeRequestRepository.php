<?php

namespace App\Repositories;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Models\ChangeRequest;

class ChangeRequestRepository implements ChangeRequestRepositoryInterface
{
    public function getAllChangeRequests()
    {
        $changeRequest = ChangeRequest::select([
            'id',
            'employee_id',
            'field_name',
            'old_value',
            'new_value',
            'status',
        ])->paginate(10);

        return $changeRequest->load(['employee']);
    }

    public function getChangeRequestById(ChangeRequest $changeRequest)
    {
        return $changeRequest->load(['employee']);
    }

    public function deleteChangeRequest(ChangeRequest $changeRequest)
    {
        $changeRequest->delete();
    }

    public function createChangeRequest(array $attributes)
    {
        return ChangeRequest::create($attributes)->load(['employee']);
    }

    public function updateChangeRequest(ChangeRequest $changeRequest, array $attributes)
    {
        $changeRequest->update($attributes);
        return $changeRequest->refresh()->load(['employee']);
    }
}