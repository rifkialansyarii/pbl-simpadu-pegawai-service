<?php

namespace App\Contracts;

use App\Models\ClassSession;

interface ClassSessionRepositoryInterface
{
    public function getAll();
    public function getById(ClassSession $classSession);
    public function delete(ClassSession $classSession);
    public function generate(array $data);
    public function create(array $data);
    public function update(ClassSession $classSession, array $data);
}