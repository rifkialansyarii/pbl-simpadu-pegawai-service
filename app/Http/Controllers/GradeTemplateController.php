<?php

namespace App\Http\Controllers;

use App\Exports\GradeTemplateExport;
use App\Http\Requests\DownloadTemplateRequest;
use App\Http\Requests\UploadTemplateRequest;
use App\Imports\GradeTemplateImport;
use App\Models\ClassSession;
use App\Services\ClassSessionService;
use App\Services\GradeService;
use App\Services\GradeSettingService;
use App\Services\StudentSubmissionService;
use Exception;
use Illuminate\Support\Facades\Gate;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Maatwebsite\Excel\Facades\Excel;

/**
 * 
 * @group Nilai
 * Endpoint terkait operasi CRUD untuk data Setting nilai.
 */
class GradeTemplateController extends Controller
{
    public function __construct(private GradeSettingService $gradeSettingService, private ClassSessionService $classSessionService, private StudentSubmissionService $submissionService, private GradeService $gradeService)
    {
    }

    /**
     * Download Template Excel Nilai
     *
     * Endpoint ini digunakan untuk mengunduh template excel nilai
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar di sesi kelas tersebut**.
     *  
     */
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function downloadTemplate(DownloadTemplateRequest $request)
    {
        $validated = $request->validated();

        Gate::authorize('manage-grades', $validated['class_id']);

        try {
            $setting = $this->gradeSettingService->getByField('course_code', $validated);

            if (!$setting || $setting->count() === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'grade is not set',
                    'code' => 400
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

    /**
     * Upload Template Excel Nilai
     *
     * Endpoint ini digunakan untuk mengupload template excel nilai
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar di sesi kelas tersebut**.
     *  
     */
    #[ResponseFromFile(file: 'responses/grades/success_import.json', status: 201, description: 'Sukses membuat aturan nilai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function uploadTemplate(UploadTemplateRequest $request)
    {
        $validated = $request->validated();

        Gate::authorize('manage-grades', $validated['class_id']);


        try {
            $assignments = $this->classSessionService->getAssignmentByCourse($request->validated());

            Excel::import(
                new GradeTemplateImport($request->validated(), $this->gradeService, $this->submissionService, $assignments),
                $request->validated()['file']
            );

            return response()->json([
                'success' => true,
                'message' => 'data has been imported and saved',
                'code' => 200
            ], 200);

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
