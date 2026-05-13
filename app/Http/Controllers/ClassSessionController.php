<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateClassSessionRequest;
use App\Http\Resources\ClassSessionCollection;
use App\Http\Resources\ClassSessionResource;
use App\Models\ClassSession;
use App\Services\ClassSessionService;
use Illuminate\Http\Request;
class ClassSessionController extends Controller
{
    public function __construct(private ClassSessionService $service)
    {
    }

    public function index()
    {
        $classSessionCollection = new ClassSessionCollection($this->service->getAllClassSessions());
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
        $classSessionCollection = new ClassSessionCollection($this->service->generateClassSession($request->validated()));
        return $classSessionCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }
}
