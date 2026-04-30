<?php

namespace App\Contracts;

use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    public function getAll();
    public function getById(Employee $employee);
    public function getTotal();
    public function delete(Employee $employee);
    public function create(array $attributes);
    public function update(Employee $employee, array $attributes);
}