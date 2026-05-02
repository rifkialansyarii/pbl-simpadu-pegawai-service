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
    use ApiResponse;

    public function __construct(
        private VillageService $service
    ) {
    }

    public function index(): JsonResponse
    {
        try {

            return $this->sendSuccess(
                data: VillageResource::collection($this->service->getAllVillage()),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }

    }

    public function showByDistrict(string $districtCode): JsonResponse
    {        
        try {
            return $this->sendSuccess(
                data: VillageResource::collection($this->service->getVillageByDistrict($districtCode)),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }
}
