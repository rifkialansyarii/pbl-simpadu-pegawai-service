<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChangeRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'field_name' => $this->field_name,
            'old_value' => $this->old_value,
            'new_value' => $this->new_value,
            'status' => $this->status,
            'employee_id' => $this->employee_id,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
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
