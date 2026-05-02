<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProvinceResource;
use App\Services\ProvinceService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    use ApiResponse;

    public function __construct(
        private ProvinceService $service
    ) {
    }

    public function index(): JsonResponse
    {
        try {

            return $this->sendSuccess(
                data: ProvinceResource::collection($this->service->getAllProvince()),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }
}
