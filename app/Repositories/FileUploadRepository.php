<?php

namespace App\Repositories;

use App\Contracts\FileUploadRepositoryInterface;
use App\Models\ClassSession;
use App\Models\FileUpload;
use App\Models\User;
use Exception;


class FileUploadRepository implements FileUploadRepositoryInterface
{
    public function getAllByUser(string $userId)
    {
        $fileUpload = FileUpload::select([
            'id',
            'file_path',
            'original_file_name',
            'file_size',
            'mime_type',
            'created_at',
        ])->where('user_id', $userId)->get();

        $fileUpload->load(['classSessions']);

        return $fileUpload;
    }

    public function create(array $data)
    {
        FileUpload::fillAndInsert($data);

        $insertedMaterialData = FileUpload::latest()->take(count($data));

        return $insertedMaterialData->get();
    }

    public function checkFileOwnership(array $data, string $userId)
    {
        $files = FileUpload::whereIn('id', $data)->where('user_id', $userId)->get();
        return $files;
    }

    public function bulkDelete(array $data)
    {
        FileUpload::whereIn('id', $data)->delete();
    }
}