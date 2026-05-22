<?php

namespace App\Contracts;

interface FileUploadRepositoryInterface
{
    public function create(array $data, int $amount);
    public function bulkDelete(array $data);
}