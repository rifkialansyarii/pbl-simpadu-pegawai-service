<?php

namespace App\Contracts;

interface LearningMaterialRepositoryInterface
{
    public function create(string $classSessionId, array $data, int $amount);
}