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
    use ApiResponse;

    public function __construct(
        private DistrictService $service
    ) {
    }

    public function index(): JsonResponse
    {
        try {

            return $this->sendSuccess(
                data: DistrictResource::collection($this->service->getAllDistrict()),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }

    public function showByCity(string $cityCode): JsonResponse
    {        
        try {
            return $this->sendSuccess(
                data: DistrictResource::collection($this->service->getDistrictByCity($cityCode)),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }
}
