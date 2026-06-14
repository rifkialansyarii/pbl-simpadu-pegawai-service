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

        if(isset($filters['status'])){
            $changeRequest = $this->filterData($filters, $changeRequest);        
        }

        if(isset($filters['search'])){
            $changeRequest = $this->searchData($filters, $changeRequest);
        }

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
        
        if(isset($filters['status'])){
            $userChangeRequest = $this->filterData($filters, $userChangeRequest);        
        }

        if(isset($filters['search'])){
            $userChangeRequest = $this->searchData($filters, $userChangeRequest);
        }

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

    public function getTotal()
    {
        $total = ChangeRequest::count();

        return $total;
    }

    public function filterData(array $filters = [], $changeRequest){

        if(isset($filters['status'])){
            $changeRequest->where('status', $filters['status']);
        }
        return $changeRequest;
    }

    public function searchData(array $filters = [], $changeRequest)
    {
        $keyword = $filters['search'];
        if(isset($keyword)){
            $changeRequest->when($keyword, function($query, $keyword){
                return $query->where('old_value', 'like', "%{$keyword}%")
                            ->orWhere('new_value', 'like', "{$keyword}");
            });
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