<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeSettingRequest;
use App\Http\Requests\UpdateGradeSettingRequest;
use App\Http\Resources\GradeSettingCollection;
use App\Http\Resources\GradeSettingResource;
use App\Models\GradeSetting;
use App\Services\GradeSettingService;
use Exception;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\ResponseFromFile;

/**
 * 
 * @group Setting Nilai
 * Endpoint terkait operasi CRUD untuk data Setting nilai.
 */
class GradeSettingController extends Controller
{
    public function __construct(private GradeSettingService $service)
    {
    }

    /**
     * Ambil Semua Data Aturan Nilai
     *
     * Endpoint ini digunakan untuk mengambil semua data aturan nilai
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar di sesi kelas tersebut**.
     *  
     */
    #[ResponseFromFile(file: 'responses/grade_settings/success.json', status: 201, description: 'Sukses mengambil aturan nilai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function index(Request $request)
    {
        $gradeSettingCollection = new GradeSettingCollection($this->service->getAllSetting($request->user()));
        return $gradeSettingCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }

    /**
     * Buat Aturan Nilai
     *
     * Endpoint ini digunakan untuk membuat aturan nilai
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar di sesi kelas tersebut**.
     *  
     */
    #[ResponseFromFile(file: 'responses/grade_settings/success_create.json', status: 201, description: 'Sukses membuat aturan nilai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function store(StoreGradeSettingRequest $request)
    {
        try {
            $attributes = [
                'assignment' => $request->validated()['assignment'],
                'uts' => $request->validated()['uts'],
                'uas' => $request->validated()['uas'],
            ];

            $total = $attributes['assignment'] + $attributes['uts'] + $attributes['uas'];

            if (!($total === 100)) {
                return response()->json([
                    'success' => true,
                    'message' => 'grade total percentage must be exactly 100',
                    'code' => '422',
                ], 422);
            }

            $gradeSettingResource = new GradeSettingResource($this->service->createSetting($request->validated(), $request->user()));
            return $gradeSettingResource->additional([
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
     * Update Aturan Nilai
     *
     * Endpoint ini digunakan untuk update aturan nilai
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **dosen yang mengajar di sesi kelas tersebut**.
     *  
     */
    #[ResponseFromFile(file: 'responses/grade_settings/success_update.json', status: 201, description: 'Sukses menambahkan materi')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    public function update(UpdateGradeSettingRequest $request, GradeSetting $gradeSetting)
    {
        try {
            $attributes = [
                'assignment' => $request->validated()['assignment'],
                'uts' => $request->validated()['uts'],
                'uas' => $request->validated()['uas'],
            ];

            $total = $attributes['assignment'] + $attributes['uts'] + $attributes['uas'];

            if (!($total === 100)) {
                return response()->json([
                    'success' => true,
                    'message' => 'grade total percentage must be exactly 100',
                    'code' => '422',
                ], 422);
            }

            $gradeSettingResource = new GradeSettingResource($this->service->updateSetting($request->validated(), $request->user(), $gradeSetting));
            return $gradeSettingResource->additional([
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

}
