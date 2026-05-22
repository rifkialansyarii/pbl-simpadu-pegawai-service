<?php

namespace App\Services;

use App\Contracts\LearningMaterialRepositoryInterface;
use App\Models\LearningMaterial;
use DB;
use Illuminate\Support\Facades\Storage;
use Throwable;


final class LearningMaterialService
{
    public function __construct(
        private LearningMaterialRepositoryInterface $repository,
    ) {
    }

    public function uploadMaterials(array $attributes)
    {
        $materialsData = array();
        $amount = 1;

        foreach ($attributes['learning_materials'] as $file) {
            $path = $file->store('learning_materials', 'private');

            $materialsData[] = [
                'file_path' => $path,
                'original_file_name' => $file->getClientOriginalName(),
                'file_size' => Storage::disk('private')->size($path),            ];

            $amount++;
        }

        try {
            return DB::transaction(function () use ($materialsData, $attributes, $amount) {
                return $this->repository->create($attributes['class_session_id'], $materialsData, $amount);
            });
        } catch (Throwable $th) {
            foreach ($materialsData as $data) {
                if(Storage::disk('private')->exists($data['file_path'])){
                    Storage::disk('private')->delete($data['file_path']);
                }
            }

            throw $th;
        }

    }

    public function getDownloadPath($learningMaterial)
    {
        return Storage::disk('private')->path($learningMaterial->file_path);
    }

}