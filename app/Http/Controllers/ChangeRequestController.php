<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterChangeRequest;
use App\Http\Requests\UpdateChangeRequest;
use App\Http\Resources\ChangeRequestCollection;
use App\Http\Resources\ChangeRequestResource;
use App\Models\ChangeRequest;
use App\Services\ChangeRequestService;
use Exception;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\UrlParam;

/**
 * @group Verifikasi / Permintaan Perubahan
 * 
 * Endpoint terkait operasi verifikasi / permintaan perubahan data pegawai tertentu SIMPADU.
 */
class ChangeRequestController extends Controller
{

    public function __construct(
        private ChangeRequestService $service
    ) {
    }

    /**
     * Ambil Semua Permintaan Perubahan Data
     * 
     * Endpoint bertujuan untuk **mengambil seluruh data permintaan perubahan**.
     * 
     * Jika usernya adalah **admin-pegawai** atau **super-admin** maka akan menampilkan **SEMUA DATA** permintaan perubahan.
     * 
     * Jika usernya adalah **dosen** maka hanya akan menampilkan semua **data permintaan perubahan milik dosen** (sebagai history).
     *  
     */
    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[ResponseFromFile(
        file: 'responses/change_request/success_get_all.json',
        status: 200,
        description: 'Sukses mendapatkan data permintaan perubahan'
    )]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function index(FilterChangeRequest $request)
    {
        try {
            $filters = $request->validated();

            $changeRequestCollection = new ChangeRequestCollection($this->service->getAllChangeRequest($request->user(), $filters));
            return $changeRequestCollection->additional([
                'success' => true,
                'code' => 200,
                'message' => 'Data retrieved successfully',
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
     * Ubah Status Permintaan Perubahan Data
     * 
     * Endpoint bertujuan untuk **mengubah status permintaan perubahan**.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **admin-pegawai** dan **super-admin**.
     * 
     * Ada tiga status permintaan perubahan:
     * 
     * - pending
     * - rejected
     * - approved
     * 
     * Jika **APPROVED** maka otomatis **data yang diajukan untuk dirubah otomatis berubah**.
     * 
     */
    #[ResponseFromFile(file: 'responses/change_request/success_get_detail.json', status: 200, description: 'Sukses mengubah data permintaan perubahan')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[UrlParam("change-request", "string", "UUID Permintaan Perubahan", example: "123e4567-e89b-12d3-a456-426614174000")]
    public function update(UpdateChangeRequest $request, ChangeRequest $changeRequest)
    {
        $changeRequestResource = new ChangeRequestResource($this->service->updateChangeRequest($changeRequest, $request->validated()));
        return $changeRequestResource->additional([
            'success' => true,
            'code' => 200,
            'message' => 'Data updated successfully',
        ]);
    }

    /**
     * Mengambil 5 data terbaru
     * 
     * Endpoint bertujuan untuk **mengambil 5 data permintaan perubahan terbaru**.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **admin-pegawai** dan **super-admin**.
     * 
     */
    #[ResponseFromFile(file: 'responses/change_request/success_get_all.json', status: 200, description: 'Sukses mengambil 5 data permintaan perubahan terbaru')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function showNewly()
    {
        $changeRequestResource = new ChangeRequestCollection($this->service->getNewlyData());
        return $changeRequestResource->additional([
            'success' => true,
            'code' => 200,
            'message' => 'Data retrieved successfully',
        ]);
    }

    /**
     * Mengambil total status pending
     * 
     * Endpoint bertujuan untuk **mengambil total data permintaan perubahan dengan status pending**.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **admin-pegawai** dan **super-admin**.
     * 
     */
    #[ResponseFromFile(file: 'responses/change_request/success_get_total_pending.json', status: 200, description: 'Sukses mendapatkan total data pegawai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function showTotalPendingStatus()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
            'data' => [
                'total_pending' => $this->service->getTotalPendingStatus()
            ]
        ]);
    }


    /**
     * Mengambil total data
     * 
     * Endpoint bertujuan untuk **mengambil total data permintaan perubahan**.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **admin-pegawai** dan **super-admin**.
     * 
     */
    #[ResponseFromFile(file: 'responses/change_request/success_get_total_pending.json', status: 200, description: 'Sukses mendapatkan total')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]

    public function showTotal()
    {
        try {
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Data retrieved successfully',
                'data' => [
                    'total' => $this->service->getTotal()
                ]
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