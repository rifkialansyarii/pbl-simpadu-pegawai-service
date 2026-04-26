<?php

namespace App\Contracts;

use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    public function getAllEmployees();
    public function getEmployeeById(Employee $employee);
    public function deleteEmployee(Employee $employee);
    public function createEmployee(array $attributes);
    public function updateEmployee(Employee $employee, array $attributes);
}