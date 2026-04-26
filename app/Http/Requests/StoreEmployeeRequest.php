<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'header_content_type' => $this->header('Content-Type'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'header_content_type' => 'required|in:application/json',

            'nip' => 'required|string|unique:App\Models\Employee,nip|size:18',
            'nik' => 'required|string|unique:App\Models\Employee,nik|size:16',
            'employee_name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'birth_place' => 'string|max:255',
            'birth_date' => [Rule::date()->format('Y-m-d')],
            'gender' => [Rule::enum(Gender::class)],
            'phone_number' => 'string|min:10|max:15|unique:App\Models\Employee,phone_number',
            'avatar' => 'string|max:255',
            'village_code' => 'string|size:10',
            'district_code' => 'string|size:6',
            'city_code' => 'string|size:4',
            'province_code' => 'string|size:2',
        ];
    }
}