<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChangeRequest;
use App\Http\Requests\UpdateChangeRequest;
use App\Http\Resources\ChangeRequestCollection;
use App\Http\Resources\ChangeRequestResource;
use App\Models\ChangeRequest;
use App\Services\ChangeRequestService;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\UrlParam;

/**
 * @group ChangeRequest
 * 
 * Endpoint terkait operasi permintaan perubahan data pegawai tertentu SIMPADU.
 */
class ChangeRequestController extends Controller
{

    public function __construct(
        private ChangeRequestService $service
    ) {
    }

    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[ResponseFromFile(
        file: 'responses/change_request/success_get_all.json', 
        status: 200, 
        description: 'Sukses mendapatkan data permintaan perubahan. Note:
                      Jika role admin akan menampilkan semua data, 
                      Jika role dosen hanya menampilkan data miliknya sendiri'
    )]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function index(Request $request)
    {
        $changeRequestCollection = new ChangeRequestCollection($this->service->getAllChangeRequest($request->user()));
        return $changeRequestCollection->additional([
            'success' => true,
            'code' => 200,
            'message' => 'Data retrieved successfully',
        ]);
    }

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

    #[ResponseFromFile(file: 'responses/change_request/success_get_all.json', status: 200, description: 'Sukses mengubah data permintaan perubahan')]
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
}