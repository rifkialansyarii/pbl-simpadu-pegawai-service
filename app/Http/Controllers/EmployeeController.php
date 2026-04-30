<?php

namespace App\Http\Controllers;

use App\Contracts\EmployeeRepositoryInterface;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Employee Management
 * 
 */
class EmployeeController extends Controller
{
    use ApiResponse;

    public function __construct(
        private EmployeeRepositoryInterface $repository
    ) {
    }

    /**
     * @queryParam page int Field to display employee per page.
     */
    public function index(): JsonResponse
    {
        try {

            return $this->sendSuccess(
                data: EmployeeResource::collection($this->repository->getAllEmployees()),
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
                data: new EmployeeResource($this->repository->getEmployeeById($employee)),
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
            $attributes = $request->validated();

            $employee = $this->repository->createEmployee($attributes);

            return $this->sendSuccess(
                data: new EmployeeResource($employee),
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
            $attributes = $request->validated();

            $newEmployee = $this->repository->updateEmployee($employee, $attributes);

            return $this->sendSuccess(
                data: new EmployeeResource($newEmployee),
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

            $this->repository->deleteEmployee($employee);

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
}