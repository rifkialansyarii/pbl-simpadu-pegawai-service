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
    use ApiResponse;

    public function __construct(
        private CityService $service
    ) {
    }

    public function index(): JsonResponse
    {
        try {

            return $this->sendSuccess(
                data: CityResource::collection($this->service->getAllCity()),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }

    public function showByProvince(string $provinceCode): JsonResponse
    {        
        try {

            return $this->sendSuccess(
                data: CityResource::collection($this->service->getCityByProvince($provinceCode)),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }
}
