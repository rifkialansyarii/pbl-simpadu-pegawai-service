<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LearningMaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => (string) $this->id,
            "file_path" => $this->file_path,
            "original_file_name" => $this->original_file_name,
            "file_size" => $this->file_size,
        ];
    }

    public function withResponse(Request $request, $response): void
    {
        $originalData = $response->getData(true);
        $response->setData([
            'success' => $originalData['success'] ?? true,
            'message' => $originalData['message'] ?? "Data retrieved successfully",
            'code' => $originalData['code'] ?? 200,

            'data' => $originalData['data'] ?? [],
        ]);

        $response->setStatusCode($originalData['code'] ?? 200);
    }
}
