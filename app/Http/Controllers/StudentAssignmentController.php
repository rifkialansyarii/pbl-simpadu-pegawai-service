<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStudentAssignmentRequest;
use App\Http\Requests\DeleteStudentAssignmentRequest;
use App\Http\Resources\ClassSessionResource;
use App\Http\Resources\StudentAssignmentCollection;
use App\Models\ClassSession;
use App\Services\StudentAssignmentService;
use Exception;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\ResponseFromFile;
/**
 * 
 * @group Sesi Kelas
 * Endpoint terkait operasi CRUD untuk data sesi kelas, termasuk generate, pembaruan, penghapusan, dan pengambilan data sesi kelas.
 */
class StudentAssignmentController extends Controller
{
    public function __construct(private StudentAssignmentService $service)
    {
    }

    public function showPendingSubmission(Request $request)
    {
        try {
            $assignmentCollection = new StudentAssignmentCollection($this->service->getPendingSubmission($request->user()));
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
                'errrors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }


    /**
     * Tambah Tugas
     *
     * Endpoint ini digunakan untuk membuat tugas pada sesi kelas
     * 
     * Endpoint ini mendukung multiple insert
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar di sesi kelas tersebut**.
     *  
     */
    #[ResponseFromFile(file: 'responses/class_sessions/success_add_material.json', status: 200, description: 'Sukses menambahkan materi')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function storeStudentAssignment(AddStudentAssignmentRequest $request, ClassSession $classSession)
    {
        try {
            $validated = $request->validated();
            $attributes = [
                'file_upload_id' => $validated['file_uuids'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'deadline' => $validated['deadline'],
            ];

            $classSessionResource = new ClassSessionResource($this->service->addStudentAssignment($classSession, $attributes));
            return $classSessionResource->additional([
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
                'errrors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }

    }

    /**
     * Hapus Tugas
     *
     * Endpoint ini digunakan untuk menghapus tugas pada sesi kelas
     * 
     * Endpoint ini mendukung multiple delete
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar di sesi kelas tersebut**.
     *  
     */
    #[ResponseFromFile(file: 'responses/file_upload/success_delete.json', status: 200, description: 'Sukses menghapus tugas')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function destroyStudentAssignment(DeleteStudentAssignmentRequest $request, ClassSession $classSession)
    {
        try {
            $attributes = $request->validated()['assignment_uuids'];

            $this->service->deleteStudentAssignment($attributes);
            return response()->json([
                'success' => true,
                'message' => 'Data deleted successfully',
                'code' => 200,
                'deleted_count' => count($attributes)
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
