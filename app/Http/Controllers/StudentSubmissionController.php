<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteStudentAssignmentRequest;
use App\Http\Requests\StoreStudentSubmission;
use App\Http\Resources\StudentSubmissionCollection;
use App\Http\Resources\StudentSubmissionResource;
use App\Models\ClassSession;
use App\Models\StudentAssignment;
use App\Services\StudentSubmissionService;
use Exception;
use Illuminate\Http\Request;

class StudentSubmissionController extends Controller
{
    public function __construct(private StudentSubmissionService $service)
    {
    }

    public function store(StoreStudentSubmission $request, StudentAssignment $studentAssignment)
    {
        try {
            $submissionResource = new StudentSubmissionResource($this->service->createSubmission($request->validated(), $studentAssignment, $request->user()));
            return $submissionResource->additional([
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

    public function destroy(Request $request, StudentAssignment $studentAssignment)
    {
        try {
            $this->service->deleteSubmission($studentAssignment, $request->user());
            return response()->json([
                'success' => true,
                'message' => 'Data deleted successfully',
                'code' => 200,
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
