<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;
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
        $employeCollection = new EmployeeCollection($this->service->getAllEmployees());
        return $employeCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
        ;
    }

    public function show(Employee $employee)
    {
        $employeeResource = new EmployeeResource($this->service->getEmployeeById($employee));
        $employeeResource->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
        return $employeeResource;
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employeeResource = new EmployeeResource($this->service->createEmployee($request->validated()));
        $employeeResource->additional([
            'success' => true,
            'message' => 'Data created successfully',
            'code' => 201,
        ]);
        return $employeeResource;
    }


    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employeeResource = new EmployeeResource($this->service->updateEmployee($request, $employee));
        $employeeResource->additional([
            'success' => true,
            'message' => 'Data updated successfully',
            'code' => 200,
        ]);
        return $employeeResource;
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