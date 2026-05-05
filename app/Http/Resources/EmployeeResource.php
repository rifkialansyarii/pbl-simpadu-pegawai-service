<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravolt\Indonesia\Models\Village;

class EmployeeResource extends JsonResource
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

    /**
     * 2. Gunakan withResponse untuk mencegat dan menyusun ulang JSON!
     */
    public function withResponse(Request $request, $response): void
    {
        $originalData = $response->getData(true);

        $response->setData([
            'success' => $this->success,
            'message' => $this->message,
            'code' => $this->code,
            
            'data'    => $originalData['data'] ?? [],
            'first_page_url'    => $originalData['first_page_url'] ?? [],
            'from'    => $originalData['from'] ?? [],
            'last_page'    => $originalData['last_page'] ?? [],
            'last_page_url'    => $originalData['last_page_url'] ?? [],
            'links'   => $originalData['links'] ?? [],
            'next_page_url'    => $originalData['next_page_url'] ?? [],
            'path'    => $originalData['path'] ?? [],
            'per_page'    => $originalData['per_page'] ?? [],
            'prev_page_url'    => $originalData['prev_page_url'] ?? [],
            'to'    => $originalData['to'] ?? [],
            'total'    => $originalData['total'] ?? [],
        ]);
    }
}