<?php

namespace App\Contracts;

use App\Models\User;


interface StudentSubmissionRepositoryInterface
{
    public function getNotSubmitted(User $user);
}
