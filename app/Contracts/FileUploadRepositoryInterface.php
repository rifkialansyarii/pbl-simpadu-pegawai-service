<?php

namespace App\Contracts;

interface FileUploadRepositoryInterface
{
    public function create(array $data);
    public function bulkDelete(array $data);
}