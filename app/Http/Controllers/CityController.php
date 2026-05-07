<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityCollection;
use App\Services\CityService;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\UrlParam;

/**
 * Endpoint untuk wilayah.
 *
 * @group Wilayah
 */
class CityController extends Controller
{

    public function __construct(
        private CityService $service
    ) {
    }

    /**
     * @unauthenticated
     */
    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[ResponseFromFile(file: 'responses/region/success_get_city.json', status: 200, description: 'Sukses mendapatkan data kota')]
    public function index()
    {
        $cityCollection = new CityCollection($this->service->getAllCity());
        return $cityCollection->additional([
            'success' => true,
            'message' => "Data retrieved successfully",
            'code' => 200,
        ]);
    }


     /**
     * @unauthenticated
     */
    #[UrlParam("provinceCode", "string", "Kode Provinsi", example: "63")]
    #[ResponseFromFile(file: 'responses/region/success_get_city.json', status: 200, description: 'Sukses mendapatkan data kota')]
    public function showByProvince(string $provinceCode)
    {        

        $cityCollection = new CityCollection($this->service->getCityByProvince($provinceCode));
        return $cityCollection->additional([
            'success' => true,
            'message' => "Data retrieved successfully",
            'code' => 200,
        ]);
    }
}
