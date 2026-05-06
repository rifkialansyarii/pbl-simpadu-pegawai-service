<?php

namespace App\Http\Controllers;

use App\Http\Resources\DistrictCollection;
use App\Services\DistrictService;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\UrlParam;

/**
 * Endpoint untuk wilayah.
 *
 * @group Wilayah
 */
class DistrictController extends Controller
{
    /**
     * Endpoint untuk wilayah.
     *
     * @group Wilayah
     */
    public function __construct(
        private DistrictService $service
    ) {
    }

    /**
     * @unauthenticated
     */
    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[ResponseFromFile(file: 'responses/region/success_get_district.json', status: 200, description: 'Sukses mendapatkan data kecamatan')]
    public function index()
    {

        $districtCollection = new DistrictCollection($this->service->getAllDistrict());
        return $districtCollection->additional([
            'success' => true,
            'message' => "Data retrieved successfully",
            'code' => 200,
        ]);
    }

    #[UrlParam("cityCode", "string", "Kode Kota", example: "6301")]
    #[ResponseFromFile(file: 'responses/region/success_get_district.json', status: 200, description: 'Sukses mendapatkan data kecamatan')]
    public function showByCity(string $cityCode)
    {
        $districtCollection = new DistrictCollection($this->service->getDistrictByCity($cityCode));
        return $districtCollection->additional([
            'success' => true,
            'message' => "Data retrieved successfully",
            'code' => 200,
        ]);
    }
}
