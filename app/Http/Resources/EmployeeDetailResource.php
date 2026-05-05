<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeDetailResource extends JsonResource
{
    public function __construct(private bool $success = true, private int $code = 200, private string $message, public $resource)
    {
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function withResponse(Request $request, $response): void
    {
        $originalData = $response->getData(true);

        $response->setData([
            'success' => $this->success,
            'message' => $this->message,
            'code' => $this->code,

            'data' => $originalData['data'] ?? [],
        ]);
    }
}
