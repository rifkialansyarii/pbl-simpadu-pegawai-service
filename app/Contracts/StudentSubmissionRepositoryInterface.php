<?php

namespace App\Contracts;

use App\Models\StudentAssignment;
use App\Models\User;

interface StudentSubmissionRepositoryInterface
{
    public function createSubmission(array $attributes, StudentAssignment $studentAssignment, User $user);
    public function checkIsSubmitted(StudentAssignment $studentAssignment, User $user): bool;
    public function deleteSubmission(StudentAssignment $studentAssignment, User $user);

}
