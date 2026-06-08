<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentSubmissionCollection;
use App\Services\StudentSubmissionService;
use Exception;
use Illuminate\Http\Request;

class StudentSubmissionController extends Controller
{
    public function __construct(private StudentSubmissionService $service)
    {
    }

    public function notSubmitted(Request $request)
    {
        try {
            $submissionCollection = new StudentSubmissionCollection($this->service->getNotSubmitted($request->user()));
            return $submissionCollection->additional([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'code' => 200,
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
