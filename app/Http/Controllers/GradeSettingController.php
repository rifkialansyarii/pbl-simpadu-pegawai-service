<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeSettingRequest;
use App\Http\Resources\GradeSettingCollection;
use App\Http\Resources\GradeSettingResource;
use App\Services\GradeSettingService;
use Exception;
use Illuminate\Http\Request;

class GradeSettingController extends Controller
{
    public function __construct(private GradeSettingService $service) {
    }

    public function store(StoreGradeSettingRequest $request)
    {
        try {
            $attributes = [
                'assignment' => $request->validated()['assignment'],
                'uts' => $request->validated()['uts'],
                'uas' => $request->validated()['uas'],
            ];

            $total = $attributes['assignment'] + $attributes['uts'] + $attributes['uas'];

            if (!($total === 100)) {
                return response()->json([
                    'success' => true,
                    'message' => 'grade total percentage must be exactly 100',
                    'code' => '422',
                ], 422);
            }

            $gradeSettingResource = new GradeSettingResource($this->service->createSetting($request->validated(), $request->user()));
            return $gradeSettingResource->additional([
                'success' => true,
                'message' => 'Data created successfully',
                'code' => 201,
            ]);
        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }
}
