<?php

namespace App\Http\Controllers;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Http\Requests\StoreChangeRequest;
use App\Http\Requests\UpdateChangeRequest;
use App\Http\Resources\ChangeRequestResource;
use App\Models\ChangeRequest;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class ChangeRequestController extends Controller
{
    use ApiResponse;

    public function __construct(
        private ChangeRequestRepositoryInterface $repository
    ) {
    }

    public function index(): JsonResponse
    {
        try {

            return $this->sendSuccess(
                data: ChangeRequestResource::collection($this->repository->getAllChangeRequests()),
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

            $attributes['employee_id'] = $user->id;


            $changeRequest = $this->repository->createChangeRequest($attributes);

            return $this->sendSuccess(
                data: new ChangeRequestResource($changeRequest),
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

            $newChangeRequest = $this->repository->updateChangeRequest($changeRequest, $attributes);

            return $this->sendSuccess(
                data: new ChangeRequestResource($newChangeRequest),
                message: 'Data updated successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage(),
            );
        }
    }
}