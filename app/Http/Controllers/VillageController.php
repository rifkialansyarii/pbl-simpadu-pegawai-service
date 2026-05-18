<?php

namespace App\Http\Controllers;

use App\Http\Resources\VillageCollection;
use App\Services\VillageService;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\UrlParam;

/**
 *
 * @group Wilayah
 */
class VillageController extends Controller
{
    public function __construct(
        private VillageService $service
    ) {
    }


    /**
     *
     * Ambil semua data kelurahan / desa
     * 
     * Endpoint bertujuan untuk **mengambil semua data kelurahan / desa**.
     * 
     * Endpoint ini **bersifat publik**.
     * 
     * @unauthenticated
     */
    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[ResponseFromFile(file: 'responses/region/success_get_village.json', status: 200, description: 'Sukses mendapatkan data desa/kelurahan')]
    public function index()
    {
        $villageCollection = new VillageCollection($this->service->getAllVillage());
        return $villageCollection->additional([
            'success' => true,
            'message' => "Data retrieved successfully",
            'code' => 200,
        ]);

    }

    /**
     *
     * Ambil kelurahan berdasarkan kecamatan
     * 
     * Endpoint bertujuan untuk **mengambil semua data kelurahan berdasarkan kecamatan**.
     * 
     * Endpoint ini **bersifat publik**.
     * 
     * @unauthenticated
     */
    #[UrlParam("districtCode", "string", "Kode Kecamatan", example: "630101")]
    #[ResponseFromFile(file: 'responses/region/success_get_village.json', status: 200, description: 'Sukses mendapatkan data desa/kelurahan')]
    public function showByDistrict(string $districtCode)
    {
        $villageCollection = new VillageCollection($this->service->getVillageByDistrict($districtCode));
        return $villageCollection->additional([
            'success' => true,
            'message' => "Data retrieved successfully",
            'code' => 200,
        ]);
    }
}
