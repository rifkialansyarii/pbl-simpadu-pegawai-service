<?php

namespace App\Repositories;

use App\Contracts\FileUploadRepositoryInterface;
use App\Models\ClassSession;
use App\Models\FileUpload;


class FileUploadRepository implements FileUploadRepositoryInterface
{
    public function create(array $data)
    {
        FileUpload::fillAndInsert($data);

        $insertedMaterialData = FileUpload::latest()->take(count($data));

        return $insertedMaterialData->get();
    }

    public function bulkDelete(array $data)
    {
        FileUpload::destroy($data);
    }
}