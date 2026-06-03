<?php

namespace App\Repositories;

use App\Contracts\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll(array $filters = [])
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
            'citizen_code',
        ])->when(isset($filters['search']), function ($query) use ($filters) {
            $query->where('employee_name', 'like', "%{$filters['search']}%")->orWhere('nip', 'like', "%{$filters['search']}%")->orWhere('nik', 'like', "%{$filters['search']}%");
        })->paginate(10);

        $employee->load(['village', 'district', 'city', 'province', 'citizen']);

        return $employee;
    }

    public function getTotal()
    {
        return Employee::count();
    }

    public function getById(Employee $employee)
    {
        $employee->select([
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
            'citizen_code',
        ]);

        $employee->load(['village', 'district', 'city', 'province', 'citizen']);

        return $employee;
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
    }

    public function create(array $attributes)
    {
        return Employee::create($attributes)->load(['village', 'district', 'city', 'province', 'citizen']);
    }

    public function update(Employee $employee, array $attributes)
    {
        $employee->update($attributes);
        return $employee->refresh()->load(['village', 'district', 'city', 'province', 'citizen']);
    }
}