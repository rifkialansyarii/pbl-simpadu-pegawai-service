<?php

namespace App\Contracts;

use App\Models\ClassSession;

interface ClassSessionRepositoryInterface
{
    public function getAll();
    public function getById(ClassSession $classSession);
    public function delete(ClassSession $classSession);
    public function create(array $attributes);
    public function update(ClassSession $classSession, array $attributes);
}