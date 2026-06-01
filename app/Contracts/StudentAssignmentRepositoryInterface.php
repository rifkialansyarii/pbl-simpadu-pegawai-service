<?php

namespace App\Contracts;

use App\Models\ClassSession;
use App\Models\User;

interface StudentAssignmentRepositoryInterface
{
    public function createStudentAssignment(ClassSession $classSession, array $data);
    public function deleteStudentAssignment(array $data);

}
