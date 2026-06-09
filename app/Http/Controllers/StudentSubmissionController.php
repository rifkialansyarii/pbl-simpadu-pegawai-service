<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteStudentAssignmentRequest;
use App\Http\Requests\StoreStudentSubmission;
use App\Http\Resources\StudentAssignmentCollection;
use App\Http\Resources\StudentSubmissionCollection;
use App\Http\Resources\StudentSubmissionResource;
use App\Models\ClassSession;
use App\Models\StudentAssignment;
use App\Services\FileUploadService;
use App\Services\StudentAssignmentService;
use App\Services\StudentSubmissionService;
use Exception;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use function PHPUnit\Framework\isEmpty;

/**
 * 
 * @group Tugas
 * Endpoint terkait operasi CRUD untuk data Tugas, termasuk membuat, penghapusan, pengumpulan dan batal pengumpulan.
 */
class StudentSubmissionController extends Controller
{
    public function __construct(private StudentSubmissionService $service, private StudentAssignmentService $assignmentService, private FileUploadService $fileUploadService)
    {
    }

     /**
     * Ambil semua Tugas yang dikumpulkan
     *
     * Endpoint ini digunakan untuk mengambil data tugas yang sudah dikumpulkan
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar pada sesi**.
     *  
     */
    #[ResponseFromFile(file: 'responses/submission/get_all.json', status: 200, description: 'Sukses mengambil data')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function index(StudentAssignment $studentAssignment)
    {
        try {
            $submissionCollection = new StudentSubmissionCollection($this->service->getSubmission($studentAssignment));
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
     * Ambil Tugas Belum Dikumpulkan
     *
     * Endpoint ini digunakan untuk mengambil data tugas yang belum dikumpulkan
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **mahasiswa yang mengikuti mata kuliah di suatu kelas**.
     *  
     */
    #[ResponseFromFile(file: 'responses/submission/get_pending.json', status: 200, description: 'Sukses mengambil data')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function showPendingSubmission(Request $request)
    {
        try {
            $assignmentCollection = new StudentAssignmentCollection($this->assignmentService->getPendingSubmission($request->user()));
            return $assignmentCollection->additional([
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


    /**
     * Kumpul Tugas
     *
     * Endpoint ini digunakan untuk mengumpulkan tugas
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **mahasiswa yang mengikuti mata kuliah di suatu kelas**.
     *  
     */
    #[ResponseFromFile(file: 'responses/submission/success_submit.json', status: 201, description: 'Sukses membuat data')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function store(StoreStudentSubmission $request, StudentAssignment $studentAssignment)
    {
        try {
            // $files = $this->fileUploadService->checkFileOwnership($request->validated(), $request->user()->id);

            // if (isEmpty($files)) {

            //     $response = [
            //         'success' => false,
            //         'message' => 'Forbidden',
            //         'code' => 403,
            //     ];

            //     return response()->json($response, 403);
            // }

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

    /**
     * Batalkan Pengumpulan
     *
     * Endpoint ini digunakan untuk membatalkan pengumpulan tugas.
     * 
     * Tugas yang dibatalkan akan **terhapus** dari database.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **mahasiswa yang mengikuti mata kuliah di suatu kelas**.
     *  
     */
    #[ResponseFromFile(file: 'responses/success_delete.json', status: 200, description: 'Sukses menghapus data')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
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
