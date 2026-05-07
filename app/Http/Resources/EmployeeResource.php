<?php

namespace App\Http\Resources;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'nip' => $this->nip,
            'nik' => $this->nik,
            'employee_name' => $this->employee_name,
            'address' => $this->address,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'village_code' => $this->village_code,
            'district_code' => $this->district_code,
            'city_code' => $this->city_code,
            'province_code' => $this->province_code,
            'citizen_code' => $this->province_code,
            'village' => new VillageResource($this->whenLoaded('village')),
            'district' => new DistrictResource($this->whenLoaded('district')),
            'city' => new CityResource($this->whenLoaded('city')),
            'province' => new ProvinceResource($this->whenLoaded('province')),
            'citizen' => new CountryResource($this->whenLoaded('citizen')),
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
