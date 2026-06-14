<?php

namespace App\Http\Controllers;

use App\Http\Resources\GradeCollection;
use App\Services\GradeService;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\ResponseFromFile;

/**
 * 
 * @group Nilai
 * Endpoint terkait operasi CRUD untuk data nilai hingga aturannya (setting nilai).
 */
class GradeController extends Controller
{
    public function __construct(private GradeService $service) {
    }

    /**
     * Ambil Semua Data Nilai
     *
     * Endpoint ini digunakan untuk mengambil semua data nilai.
     * 
     * Noted: terdapat pengampu_id untuk dikirimkan KHS.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar di sesi kelas tersebut**.
     *  
    */
    #[ResponseFromFile(file: 'responses/grades/success_get.json', status: 200, description: 'Berhasil ambil data nilai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function index(string $classId, string $courseCode)
    {
        Gate::authorize('manage-grades', $classId);

        try {
            $gradeCollection = new GradeCollection($this->service->getAll($classId, $courseCode));
            return $gradeCollection->additional([
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
