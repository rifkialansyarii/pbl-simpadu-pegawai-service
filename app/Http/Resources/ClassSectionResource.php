<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassSectionResource extends JsonResource
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
            'pengampu_id' => $this->pengampu_id,
            'class_id' => $this->class_id,
            'class_name' => $this->class_name,
            'course_name' => $this->course_name,
            'topic' => $this->topic,
            'session_date' => $this->session_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
            'is_already_opened' => $this->is_already_opened,
            'lecturer_id' => $this->lecturer_id,
            'lecturer' => EmployeeResource::make($this->whenLoaded('lecturer'))
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
