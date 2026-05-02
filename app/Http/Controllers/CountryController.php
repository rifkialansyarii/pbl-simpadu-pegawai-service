<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use App\Services\CountryService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use ApiResponse;

    public function __construct(
        private CountryService $service
    ) {
    }

    public function index(): JsonResponse
    {
        try {

            return $this->sendSuccess(
                data: CountryResource::collection($this->service->getAllCountry()),
                message: 'Data retrieved successfully',
            );

        } catch (Exception $e) {
            return $this->sendError(
                message: $e->getMessage()
            );
        }
    }
}
