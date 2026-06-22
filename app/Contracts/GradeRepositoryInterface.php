<?php

namespace App\Contracts;

use App\Models\Grade;
use App\Models\User;

interface GradeRepositoryInterface
{   
    public function getAll($classId, $courseCode);
    public function getAllKeyByStudentIds($classId, $courseCode);
    public function storeGrade(User $user, array $attributes);
}