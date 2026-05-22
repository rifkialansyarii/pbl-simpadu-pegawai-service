<?php

namespace App\Services;

use App\Contracts\FileUploadRepositoryInterface;
use DB;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Throwable;


final class FileUploadService
{
    public function __construct(
        private FileUploadRepositoryInterface $repository,
    ) {
    }

    public function uploadMaterials(array $attributes)
    {
        $materialsData = array();
        $amount = 1;

        foreach ($attributes['files'] as $file) {
            $path = $file->store('files', 'private');

            $files[] = [
                'file_path' => $path,
                'original_file_name' => $file->getClientOriginalName(),
                'file_size' => Storage::disk('private')->size($path),
                'mime_type' => Storage::mimeType($path),
            ];

            $amount++;
        }

        try {
            return DB::transaction(function () use ($files, $amount) {
                return $this->repository->create($files, $amount);
            });
        } catch (Throwable $th) {
            foreach ($materialsData as $data) {
                if (Storage::disk('private')->exists($data['file_path'])) {
                    Storage::disk('private')->delete($data['file_path']);
                }
            }

            throw $th;
        }

    }

    public function getDownloadPath($fileUpload)
    {
        if ($fileUpload->file_path !== null) {
            return Storage::disk('private')->path($fileUpload->file_path);
        }
    }

    public function deleteFile(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return $this->repository->bulkDelete($attributes);
        });
    }

}