<?php

namespace App\Contracts;

use App\Models\User;

interface FileUploadRepositoryInterface
{
    public function getAllByUser(string $userId);
    public function create(array $data);
    public function checkFileOwnership(array $data, string $userId);
    public function bulkDelete(array $data);
}