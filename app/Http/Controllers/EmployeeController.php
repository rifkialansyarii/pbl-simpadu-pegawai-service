<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeDetailResource;
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
    public function __construct(
        private EmployeeService $service,
        private ChangeRequestService $changeRequestService
    ) {
    }

    public function index()
    {
        return new EmployeeResource(
            success: true,
            message: 'Data retrieved successfully',
            code: 200,
            resource: $this->service->getAllEmployees()
        );
    }

    public function show(Employee $employee)
    {
        return new EmployeeDetailResource(
            success: true,
            message: 'Data retrieved successfully',
            code: 200,
            resource: $this->service->getEmployeeById($employee)
        );
    }

    public function store(StoreEmployeeRequest $request)
    {
        return new EmployeeDetailResource(
            success: true,
            message: 'Data created successfully',
            code: 201,
            resource: $this->service->createEmployee($request->validated())
        );
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        return new EmployeeDetailResource(
            success: true,
            message: 'Data updated successfully',
            code: 200,
            resource: $this->service->updateEmployee($request, $employee)
        );
    }

    public function destroy(Employee $employee)
    {
        $this->service->deleteEmployee($employee);
        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
            'code' => 200,
        ]);
    }

    public function showTotal()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
            'data' => [
                'total_employee' => $this->service->getTotalEmployee()
            ]
        ]);
    }
}