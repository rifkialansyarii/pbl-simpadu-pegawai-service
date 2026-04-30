<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\ChangeRequestService;
use App\Services\EmployeeService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Employee Management
 * 
 */
class EmployeeController extends Controller
{
    use ApiResponse;

    public function __construct(
        private EmployeeService $service,
        private ChangeRequestService $changeRequestService
    ) {
    }

    public function index(): JsonResponse
    {
        try {

            return $this->sendSuccess(
                data: EmployeeResource::collection($this->service->getAllEmployees()),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }

    public function show(Employee $employee): JsonResponse
    {
        try {
            return $this->sendSuccess(
                data: new EmployeeResource($this->service->getEmployeeById($employee)),
                message: 'Data retrieved successfully ',
            );
        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        try {
            return $this->sendSuccess(
                data: new EmployeeResource($this->service->createEmployee($request->validated())),
                message: 'Data created successfully',
                code: 201,
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage(),
            );
        }
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): JsonResponse
    {
        try {
            return $this->sendSuccess(
                data: new EmployeeResource($this->service->updateEmployee($request, $employee)),
                message: 'Data updated successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage(),
            );
        }
    }

    public function destroy(Employee $employee): JsonResponse
    {
        try {
            $this->service->deleteEmployee($employee);
            return $this->sendSuccess(
                data: [],
                message: 'Data deleted successfully ',
            );
        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }

    public function showTotal(): JsonResponse
    {
        try {
            return $this->sendSuccess(
                data: [['total_employee' => $this->service->getTotalEmployee()]],
                message: 'Data retrieved successfully ',
            );
        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }
}