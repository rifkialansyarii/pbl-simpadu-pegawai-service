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
    public function __construct(
        private CountryService $service
    ) {
    }

    public function index()
    {
            return CountryResource::collection($this->service->getAllCountry());

    }
}
