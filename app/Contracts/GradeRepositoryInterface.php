<?php

namespace App\Contracts;

use App\Models\Grade;
use App\Models\User;

interface GradeRepositoryInterface
{   
    public function storeGrade(array $attributes);
}