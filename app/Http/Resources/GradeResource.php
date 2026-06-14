<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "pengampu_id" => $this->pengampu_id,
            "student_id" => $this->student_id,
            "nim" => $this->nim,
            "student_name" => $this->student_name,
            "class_id" => $this->class_id,
            "course_code" => $this->course_code,
            "course_name" => $this->course_name,
            "assignment_score" => $this->assignment_score,
            "uts_score" => $this->uts_score,
            "uas_score" => $this->uas_score,
            "final_score" => $this->final_score,
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
