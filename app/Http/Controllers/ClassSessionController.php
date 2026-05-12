<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassSectionCollection;
use App\Http\Resources\ClassSectionResource;
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
        $classSectionCollection = new ClassSectionCollection($this->service->getAllClassSessions());
        return $classSectionCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }

    public function show(ClassSession $classSession)
    {
        $classSessionResource = new ClassSectionResource($this->service->getClassSessionById($classSession));
        return $classSessionResource->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }
}
