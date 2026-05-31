<?php

namespace App\Contracts;

use App\Models\ClassSession;
use App\Models\User;

interface ClassSessionRepositoryInterface
{
    public function getAll();
    public function getAllByLecturer(string $lecturerId);
    public function getAllByClass(string $classId);
    public function getById(ClassSession $classSession);
    public function generate(array $data, int $sessionAmount);
    public function update(ClassSession $classSession, array $data);
    public function bulkDelete(array $data);
    public function createSessionMaterial(ClassSession $classSession, array $data);
    public function deleteSessionMaterial(ClassSession $classSession, array $data);
    public function createStudentAssignment(ClassSession $classSession, array $data);
    public function deleteStudentAssignment(ClassSession $classSession, array $data);

}
