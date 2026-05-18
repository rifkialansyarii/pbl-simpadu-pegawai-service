<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryCollection;
use App\Services\CountryService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;

/**
 *
 * @group Wilayah
 * 
 * Endpoint yang menyediakan data wilayah-wilayah pada indonesia dan seluruh negara dunia.
 * 
 */
class CountryController extends Controller
{
    public function __construct(
        private CountryService $service
    ) {
    }

    /**
     * Ambil semua data negara
     * 
     * Endpoint bertujuan untuk **mengambil semua data negara**.
     * 
     * Endpoint ini **bersifat publik**.
     * 
     * @unauthenticated
     */
    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[ResponseFromFile(file: 'responses/region/success_get_country.json', status: 200, description: 'Sukses mendapatkan data negara')]
    public function index()
    {
        $countryCollection = new CountryCollection($this->service->getAllCountry());
        return $countryCollection->additional([
            'success' => true,
            'message' => "Data retrieved successfully",
            'code' => 200,
        ]);

    }
}
