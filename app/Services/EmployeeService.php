<?php

namespace App\Services;

use App\Contracts\ChangeRequestRepositoryInterface;
use App\Contracts\EmployeeRepositoryInterface;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use Arr;

final class EmployeeService
{
    public function __construct(
        private EmployeeRepositoryInterface $repository,
        private ChangeRequestRepositoryInterface $changeRequestRepository,
    ) {
    }

    public function getAllEmployees(array $filters = [])
    {
        return $this->repository->getAll($filters);
    }

    public function getEmployeeById(Employee $employee)
    {
        return $this->repository->getById($employee);
    }

    public function createEmployee(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    public function updateEmployee(UpdateEmployeeRequest $request, Employee $employee)
    {

        $userId = $request->user()->detail_id;
        if ($request->user()->role === 'dosen') {
            $employee = Employee::find($userId);
            if ($request->has('nip') && $request->validated()['nip'] !== $employee->nip ) {
                $attributesChangeRequest = [
                    'employee_id' => $userId,
                    'field_name' => 'nip',
                    'old_value' => $employee->value('nip'),
                    'new_value' => $request->validated()['nip'],
                ];

                $this->changeRequestRepository->create($attributesChangeRequest);

            } 
            
            if ($request->has('nik') && $request->validated()['nik'] !== $employee->nik) {
                $attributesChangeRequest = [
                    'employee_id' => $userId,
                    'field_name' => 'nik',
                    'old_value' => $employee->value('nik'),
                    'new_value' => $request->validated()['nik'],
                ];

                $this->changeRequestRepository->create($attributesChangeRequest);

            } 
            
            if ($request->has('employee_name') && $request->validated('employee_name') !== $employee->employee_name) {
                $attributesChangeRequest = [
                    'employee_id' => $userId,
                    'field_name' => 'employee_name',
                    'old_value' => $employee->value('employee_name'),
                    'new_value' => $request->validated('employee_name'),
                ];
                $this->changeRequestRepository->create($attributesChangeRequest);
            }
        }

        $attributes = Arr::except($request->validated(), ['nip', 'nik', 'employee_name']);
        return $this->repository->update($employee, $attributes);
    }


    public function deleteEmployee(Employee $employee)
    {
        $this->repository->delete($employee);
    }


    public function getTotalEmployee()
    {
        return $this->repository->getTotal();
    }
}