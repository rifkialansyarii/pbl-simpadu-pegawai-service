<?php

namespace App\Repositories;

use App\Contract\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployee()
    {
        $employee = Employee::get([
            'id',
            'nip',
            'nik',
            'employee_name',
            'address',
            'birth_place',
            'birth_date',
            'gender',
            'phone_number',
            'avatar',
            'village_id',
            'district_id',
            'city_id',
            'province_id',
        ]);

        return $employee->load(['village','district', 'city', 'province']);
    }

    public function getEmployeeById(Employee $employee)
    {
        return $employee->load(['village','district', 'city', 'province']);
    }

    public function deleteEmployee(Employee $employee)
    {
        $employee->delete();
    }

    public function createEmployee(array $attributes)
    {
        return Employee::create($attributes)->load(['village','district', 'city', 'province']);
    }

    public function updateEmployee(Employee $employee, array $attributes)
    {
        $employee->update($attributes);
        return $employee->refresh()->load(['village','district', 'city', 'province']);
    }
}