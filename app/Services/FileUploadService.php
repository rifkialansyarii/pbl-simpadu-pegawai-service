<?php

namespace App\Services;

use App\Contracts\FileUploadRepositoryInterface;
use App\Http\Requests\BulkDeleteClassSessionRequest;
use App\Models\User;
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

    public function showAllFileUpload(User $user)
    {
        return $this->repository->getAllByUser($user->id);
    }

    public function uploadFile(array $attributes, string $userId)
    {
        $materialsData = array();

        foreach ($attributes['files'] as $file) {
            $path = $file->store('files', 'private');

            $files[] = [
                'user_id' => $userId,
                'file_path' => $path,
                'original_file_name' => $file->getClientOriginalName(),
                'file_size' => Storage::disk('private')->size($path),
                'mime_type' => Storage::mimeType($path),
            ];
        }

        try {
            return DB::transaction(function () use ($files) {
                return $this->repository->create($files);
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

    public function checkFileOwnership(array $data, string $userId)
    {
        return $this->repository->checkFileOwnership($data, $userId);
    }

    public function deleteFile(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return $this->repository->bulkDelete($attributes);
        });
    }

}