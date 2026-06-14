<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentSubmissionResource extends JsonResource
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
            "student_id" => $this->student_id,
            "nim" => $this->nim,
            "student_name" => $this->student_name,
            "submitted_at" => $this->submitted_at,
            "assignment_id" => $this->assignment_id,
            "assignment" => StudentAssignmentResource::make($this->whenLoaded('assignment')),
            "attachment" => FileUploadCollection::make($this->whenLoaded('submissionFiles')),
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
