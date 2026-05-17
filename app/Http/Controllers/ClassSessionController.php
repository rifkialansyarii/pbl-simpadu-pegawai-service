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
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\UrlParam;

/**
 * 
 * @group Sesi Kelas
 * Endpoint terkait operasi CRUD untuk data sesi kelas, termasuk generate, pembaruan, penghapusan, dan pengambilan data sesi kelas.
 */
class ClassSessionController extends Controller
{
    public function __construct(private ClassSessionService $service)
    {
    }

    /**
     * Ambil Semua Sesi Kelas
     * 
     * Endpoint bertujuan untuk **mengambil seluruh data sesi kelas**.
     *  
     */
    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[ResponseFromFile(file: 'responses/class_sessions/get_class_sessions.json', status: 200, description: 'Sukses mendapatkan data sesi kelas')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function index(Request $request)
    {
        $classSessionCollection = new ClassSessionCollection($this->service->getAllClassSessions($request->user()));
        return $classSessionCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }

    /**
     * Detail Sesi Kelas
     * 
     * Endpoint bertujuan untuk **melihat detail sesi kelas**.
     *  
     */
    #[ResponseFromFile(file: 'responses/class_sessions/detail_class_session.json', status: 200, description: 'Sukses mendapatkan detail sesi kelas')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/not_found.json', status: 404, description: 'Data tidak ditemukan')]
    #[UrlParam("classSession_id", "string", "UUID Sesi Kelas", example: "123e4567-e89b-12d3-a456-426614174000")]
    public function show(ClassSession $classSession)
    {
        $classSessionResource = new ClassSessionResource($this->service->getClassSessionById($classSession));
        return $classSessionResource->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }

    /**
     * Generate sesi kelas
     * 
     * Endpoint bertujuan untuk **melakukan generate 16 data sesi kelas**.
     *  
     */
    #[ResponseFromFile(file: 'responses/class_sessions/get_class_sessions.json', status: 201, description: 'Sukses generate data sesi kelas')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/unprocessable.json', status: 422, description: 'Inputan tidak valid')]
    public function generate(GenerateClassSessionRequest $request)
    {
        try {
            $classSessionCollection = new ClassSessionCollection($this->service->generateClassSession($request->validated()));
            return $classSessionCollection->additional([
                'success' => true,
                'message' => 'Data generated successfully',
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
     * Update sesi kelas
     *
     * Jika user adalah **dosen** maka **hanya dapat mengubah field status**.
     * 
     * Jika user adalah **admin-pegawai** atau **super-admin** maka **hanya dapat mengubah field topic, session_date, start_time, end_time**.
     *  
     */
    #[ResponseFromFile(file: 'responses/class_sessions/detail_class_session.json', status: 200, description: 'Sukses mengubah data sesi kelas')]
    #[ResponseFromFile(file: 'responses/class_sessions/conflict.json', status: 409, description: 'Sesi sudah pernah dibuka')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/not_found.json', status: 404, description: 'Data tidak ditemukan')]
    #[UrlParam("classSession_id", "string", "UUID Pegawai", example: "123e4567-e89b-12d3-a456-426614174000")]
    public function update(UpdateClassSessionRequest $request, ClassSession $classSession)
    {
        try {
            $classSessionResource = new ClassSessionResource($this->service->updateClassSession($request->validated(), $classSession));
            return $classSessionResource->additional([
                'success' => true,
                'message' => 'Data updated successfully',
                'code' => 200,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code' => 409,
            ], 409);
        }
    }

    /**
     * Hapus sesi kelas
     *
     * Endpoint ini **TERPAKSA** harus menggunakan **method POST** dibandingkan DELETE.
     * 
     * Hal ini dikarenakan endpoint ini mendukung *multiple delete* data atau *bulk delete*. Sehingga memerlukan body parameter / body request.
     *  
     */
    #[ResponseFromFile(file: 'responses/class_sessions/bulk_delete_class_session.json', status: 200, description: 'Sukses menghapus data pegawai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[BodyParam(name: 'uuids', type: 'string[]', description: 'Masukkan uuids data yang ingin dihapus', example: ['019e33e7-993d-7376-9c5a-c3c8078d697b', '019e33e7-993d-7376-9c5a-c3c8078d697b'])]
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
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errrors' => $e->getMessage()
            ], 500);
        }
    }
}
