<?php

namespace App\Repositories;

use App\Contracts\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll()
    {
        $employee = Employee::select([
            'id',
            'nip',
            'nik',
            'employee_name',
            'address',
            'birth_place',
            'birth_date',
            'gender',
            'phone_number',
            'village_code',
            'district_code',
            'city_code',
            'province_code',
        ])->paginate(10);

        return $employee->load(['village', 'district', 'city', 'province']);
    }

    public function getTotal()
    {
        return Employee::count();
    }

    public function getById(Employee $employee)
    {
        $employee = Employee::select([
            'id',
            'nip',
            'nik',
            'employee_name',
            'address',
            'birth_place',
            'birth_date',
            'gender',
            'phone_number',
            'village_code',
            'district_code',
            'city_code',
            'province_code',
        ])->where('id', $employee->id)->first();

        return $employee->load(['village', 'district', 'city', 'province']);
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
    }

    public function create(array $attributes)
    {
        return Employee::create($attributes)->load(['village', 'district', 'city', 'province']);
    }

    public function update(Employee $employee, array $attributes)
    {
        $employee->update($attributes);
        return $employee->refresh()->load(['village', 'district', 'city', 'province']);
    }
}