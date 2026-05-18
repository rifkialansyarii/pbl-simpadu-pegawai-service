<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProvinceCollection;
use App\Services\ProvinceService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;

/**
 *
 * @group Wilayah
 */
class ProvinceController extends Controller
{

    public function __construct(
        private ProvinceService $service
    ) {
    }

    /**
     *
     * Ambil semua data provinsi
     * 
     * Endpoint bertujuan untuk **mengambil semua data provinsi**.
     * 
     * Endpoint ini **bersifat publik**.
     * 
     * @unauthenticated
     */
    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[ResponseFromFile(file: 'responses/region/success_get_province.json', status: 200, description: 'Sukses mendapatkan data provinsi')]
    public function index()
    {

        $provinceCollection = new ProvinceCollection($this->service->getAllProvince());
        return $provinceCollection->additional([
            'success' => true,
            'message' => "Data retrieved successfully",
            'code' => 200,
        ]);

    }
}
