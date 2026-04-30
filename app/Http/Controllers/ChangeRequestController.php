<?php

namespace App\Http\Controllers;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Http\Requests\StoreChangeRequest;
use App\Http\Requests\UpdateChangeRequest;
use App\Http\Resources\ChangeRequestResource;
use App\Models\ChangeRequest;
use App\Services\ChangeRequestService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChangeRequestController extends Controller
{
    use ApiResponse;

    public function __construct(
        private ChangeRequestService $service
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        try {
            return $this->sendSuccess(
                data: ChangeRequestResource::collection($this->service->getAllChangeRequest($request->user())),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }

    public function store(StoreChangeRequest $request): JsonResponse
    {
        try {

            $attributes = $request->validated();
            $user = $request->user();

            return $this->sendSuccess(
                data: new ChangeRequestResource($this->service->createChangeRequest($attributes, $user)),
                message: 'Data created successfully',
                code: 201,
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage(),
            );
        }
    }

    public function update(UpdateChangeRequest $request, ChangeRequest $changeRequest): JsonResponse
    {
        try {
            $attributes = $request->validated();

            return $this->sendSuccess(
                data: new ChangeRequestResource($this->service->updateChangeRequest($changeRequest, $attributes)),
                message: 'Data updated successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage(),
            );
        }
    }

    public function showNewly()
    {
        try {
            return $this->sendSuccess(
                data: new ChangeRequestResource($this->service->getNewlyData()),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage(),
            );
        }
    }

    public function showTotalPendingStatus()
    {
        try {
            return $this->sendSuccess(
                data: [ ["total_pending" => $this->service->getTotalPendingStatus()] ],
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage(),
            );
        }
    }
}