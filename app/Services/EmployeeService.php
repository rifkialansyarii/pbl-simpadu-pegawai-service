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

        $userId = $request->user()->id;

        if ($request->user()->role_name === 'dosen') {
            if ($request->has('nip')) {
                $attributesChangeRequest = [
                    'employee_id' => $userId,
                    'field_name' => 'nip',
                    'old_value' => Employee::find($userId)->value('nip'),
                    'new_value' => $request->nip,
                ];

                $this->changeRequestRepository->create($attributesChangeRequest);

            } else if ($request->has('nik')) {
                $attributesChangeRequest = [
                    'employee_id' => $userId,
                    'field_name' => 'nik',
                    'old_value' => Employee::find($userId)->value('nik'),
                    'new_value' => $request->nik,
                ];

                $this->changeRequestRepository->create($attributesChangeRequest);

            } else if ($request->has('employee_name')) {
                $attributesChangeRequest = [
                    'field_name' => 'employee_name',
                    'old_value' => Employee::find($userId)->value('employee_name'),
                    'new_value' => $request->employee_name,
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