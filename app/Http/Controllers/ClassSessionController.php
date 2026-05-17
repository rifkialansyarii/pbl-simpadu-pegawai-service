<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkDeleteClassSessionRequest;
use App\Http\Requests\GenerateClassSessionRequest;
use App\Http\Requests\UpdateClassSessionRequest;
use App\Http\Resources\ClassSessionCollection;
use App\Http\Resources\ClassSessionResource;
use App\Models\ClassSession;
use App\Services\ClassSessionService;
use Exception;
use Illuminate\Http\Request;
class ClassSessionController extends Controller
{
    public function __construct(private ClassSessionService $service)
    {
    }

    public function index(Request $request)
    {
        $classSessionCollection = new ClassSessionCollection($this->service->getAllClassSessions($request->user()));
        return $classSessionCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }

    public function show(ClassSession $classSession)
    {
        $classSessionResource = new ClassSessionResource($this->service->getClassSessionById($classSession));
        return $classSessionResource->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }

    public function generate(GenerateClassSessionRequest $request)
    {
        try {
            $classSessionCollection = new ClassSessionCollection($this->service->generateClassSession($request->validated()));
            return $classSessionCollection->additional([
                'success' => true,
                'message' => 'Data genereated successfully',
                'code' => 201,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unprocessable Content',
                'code' => 422,
                'errrors' => $e->getMessage()
            ], 422);
        }

    }

    public function update(UpdateClassSessionRequest $request, ClassSession $classSession)
    {
        $classSessionResource = new ClassSessionResource($this->service->updateClassSession($request->validated(), $classSession));
        return $classSessionResource->additional([
            'success' => true,
            'message' => 'Data updated successfully',
            'code' => 200,
        ]);
    }

    public function destroy(BulkDeleteClassSessionRequest $request)
    {
        try {
            $attributes = $request->validated()['uuids'];

            $this->service->deleteClassSession($attributes);
            return response()->json([
                'success' => true,
                'message' => 'Data deleted successfully',
                'code' => 200,
                'deleted_count' => count($attributes),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unprocessable Content',
                'code' => 422,
                'errrors' => $e->getMessage()
            ]);
        }

    }

}
