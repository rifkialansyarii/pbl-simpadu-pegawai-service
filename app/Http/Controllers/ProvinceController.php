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

    public function __construct(
        private ProvinceService $service
    ) {
    }

    public function index()
    {
        return ProvinceResource::collection($this->service->getAllProvince());

    }
}
