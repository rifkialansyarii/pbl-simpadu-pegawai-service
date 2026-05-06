<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChangeRequest;
use App\Http\Requests\UpdateChangeRequest;
use App\Http\Resources\ChangeRequestResource;
use App\Models\ChangeRequest;
use App\Services\ChangeRequestService;
use Illuminate\Http\Request;

class ChangeRequestController extends Controller
{

    public function __construct(
        private ChangeRequestService $service
    ) {
    }

    public function index(Request $request)
    {
        $changeRequestResource = new ChangeRequestResource($this->service->getAllChangeRequest($request->user()));
        return $changeRequestResource->additional([
            'success' => true,
            'code' => 200,
            'message' => 'Data retrieved successfully',
        ]);
    }

    public function store(StoreChangeRequest $request)
    {
        $changeRequestResource = new ChangeRequestResource($this->service->createChangeRequest($request->validated(), $request->user()));
        return $changeRequestResource->additional([
            'success' => true,
            'code' => 201,
            'message' => 'Data created successfully',
        ]);
    }

    public function update(UpdateChangeRequest $request, ChangeRequest $changeRequest)
    {
        $changeRequestResource = new ChangeRequestResource($this->service->updateChangeRequest($changeRequest, $request->validated()));
        return $changeRequestResource->additional([
            'success' => true,
            'code' => 200,
            'message' => 'Data updated successfully',
        ]);
    }

    public function showNewly()
    {
        $changeRequestResource = new ChangeRequestResource($this->service->getNewlyData());
        return $changeRequestResource->additional([
            'success' => true,
            'code' => 200,
            'message' => 'Data retrieved successfully',
        ]);
    }

    public function showTotalPendingStatus()
    {
        $changeRequestResource = new ChangeRequestResource($this->service->getTotalPendingStatus());
        return $changeRequestResource->additional([
            'success' => true,
            'code' => 200,
            'message' => 'Data retrieved successfully',
        ]);
    }
}