<?php

namespace App\Repositories;

use App\Contracts\LearningMaterialRepositoryInterface;
use App\Models\ClassSession;
use App\Models\LearningMaterial;


class LearningMaterialRepository implements LearningMaterialRepositoryInterface
{
    public function create(string $classSessionId, array $data, int $amount)
    {
        $classSession = ClassSession::find($classSessionId);

        LearningMaterial::fillAndInsert($data);

        $insertedMaterialData = LearningMaterial::latest()->take($amount);

        $classSession->learningMaterials()->attach($insertedMaterialData->pluck('id'));

        $insertedMaterialData = $insertedMaterialData->paginate(10); 
        $insertedMaterialData->load('classSessions');

        return $insertedMaterialData;
    }
}