<?php

namespace App\Contracts;

use App\Models\ClassSession;
use App\Models\User;

interface ClassSessionRepositoryInterface
{
    public function getAll(array $filters = []);
    public function getAllByLecturer(string $lecturerId, array $filters = []);
    public function getAllByClass(string $classId, array $filters = []);
    public function getById(ClassSession $classSession);
    public function getByPengampu(string $pengampuId);
    public function searchData(array $filters = [], $classSession);
    public function generate(array $data, int $sessionAmount);
    public function update(ClassSession $classSession, array $data);
    public function bulkDelete(array $data);
    public function createSessionMaterial(ClassSession $classSession, array $data);
    public function deleteSessionMaterial(ClassSession $classSession, array $data);

}
