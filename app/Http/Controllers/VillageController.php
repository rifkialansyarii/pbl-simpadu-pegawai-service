<?php

namespace App\Http\Controllers;

use App\Http\Resources\VillageResource;
use App\Services\VillageService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function __construct(
        private VillageService $service
    ) {
    }

    public function index()
    {
            return VillageResource::collection($this->service->getAllVillage());


    }

    public function showByDistrict(string $districtCode)
    {        
            return VillageResource::collection($this->service->getVillageByDistrict($districtCode));

    }
}
