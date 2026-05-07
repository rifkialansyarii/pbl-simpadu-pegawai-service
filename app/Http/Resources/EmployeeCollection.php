<?php

namespace App\Http\Resources;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    public $collects = EmployeeResource::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }

    /**
     * 2. Gunakan withResponse untuk mencegat dan menyusun ulang JSON!
     */
    public function withResponse(Request $request, $response): void
    {
        $originalData = $response->getData(true);

        $response->setData([
            'success' => $originalData['success'] ?? true,
            'message' => $originalData['message'] ?? "Data retrieved successfully",
            'code' => $originalData['code'] ?? 200,

            'data' => $originalData['data'] ?? [],
            'meta' => $originalData['meta'] ?? [],
        ]);

        $response->setStatusCode($originalData['code'] ?? 200);
    }
}