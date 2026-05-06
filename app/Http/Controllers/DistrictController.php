<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Http\Resources\DistrictResource;
use App\Services\DistrictService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    public function __construct(
        private DistrictService $service
    ) {
    }

    public function index()
    {

        return DistrictResource::collection($this->service->getAllDistrict());
    }

    public function showByCity(string $cityCode)
    {        
        return DistrictResource::collection($this->service->getDistrictByCity($cityCode));
    }
}
