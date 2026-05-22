<?php

namespace App\Repositories;

use App\Contracts\FileUploadRepositoryInterface;
use App\Models\ClassSession;
use App\Models\FileUpload;


class FileUploadRepository implements FileUploadRepositoryInterface
{
    public function create(array $data, int $amount)
    {
        FileUpload::fillAndInsert($data);

        $insertedMaterialData = FileUpload::latest()->take($amount);

        $insertedMaterialData = $insertedMaterialData->paginate(10);

        return $insertedMaterialData;
    }

    public function bulkDelete(array $data)
    {
        FileUpload::destroy($data);
    }
}