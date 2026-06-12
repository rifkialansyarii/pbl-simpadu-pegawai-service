<?php

namespace App\Http\Controllers;

use App\Exports\GradeTemplateExport;
use App\Http\Requests\downloadTemplateRequest;
use App\Models\StudentAssignment;
use App\Services\ClassSessionService;
use App\Services\GradeSettingService;
use App\Services\StudentAssignmentService;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GradeTemplateController extends Controller
{
    public function __construct(private GradeSettingService $gradeSettingService, private ClassSessionService $classSessionService)
    {
    }

    public function downloadTemplate(downloadTemplateRequest $request)
    {
        try {
            $validated = $request->validated();

            $setting = $this->gradeSettingService->getByField('course_code', $validated);

            if ($setting->count() === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'grade is not set'
                ], 400);
            }
            $assignments = $this->classSessionService->getAssignmentByCourse($validated);
            $fileName = 'Template_Nilai_' . $validated['class_name'] . '.xlsx';

            if (ob_get_length()) {
                ob_end_clean();
            }
            ob_start();

            return Excel::download(
                new GradeTemplateExport(students: $validated['students'], assignments: $assignments, setting: $setting),
                $fileName,
                \Maatwebsite\Excel\Excel::XLSX
            );
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
