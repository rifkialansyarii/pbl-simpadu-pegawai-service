<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Services\CityService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Province;

class CityController extends Controller
{

    public function __construct(
        private CityService $service
    ) {
    }

    public function index()
    {
        return CityResource::collection($this->service->getAllCity());

    }

    public function showByProvince(string $provinceCode)
    {        

        return CityResource::collection($this->service->getCityByProvince($provinceCode));
    }
}
