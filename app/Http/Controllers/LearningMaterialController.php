<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLearningMaterialRequest;
use App\Http\Resources\LearningMaterialCollection;
use App\Services\LearningMaterialService;
use Exception;
use Illuminate\Http\Request;

class LearningMaterialController extends Controller
{
    public function __construct(private LearningMaterialService $service)
    {
    }

    public function store(StoreLearningMaterialRequest $request)
    {
        try {
            $learningMaterialCollection = new LearningMaterialCollection($this->service->uploadMaterials($request->validated()));
            return $learningMaterialCollection->additional([
                'success' => true,
                'message' => 'Data generated successfully',
                'code' => 201,
            ]);
        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errrors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }
}
