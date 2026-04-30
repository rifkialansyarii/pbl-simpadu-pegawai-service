<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Enums\JenisKelamin;
use App\Models\Employee;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    use ApiResponse;

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
        $isAdmin = $this->user()->role === 'admin';

        return [
            'header_content_type' => 'required|in:application/json',

            'nip' => $isAdmin ? [
                'string',
                'size:18',
                Rule::unique(Employee::class)->ignore($this->route('employee')),
            ] : 'prohibited',
            'nik' => $isAdmin ? [
                'string',
                'size:16',
                Rule::unique(Employee::class)->ignore($this->route('employee')),
            ] : 'prohibited',
            'employee_name' => $isAdmin ? 'string|max:255' : 'prohibited',
            'address' => 'string|max:255',
            'birth_place' => 'string|max:255',
            'birth_date' => [Rule::date()->format('Y-m-d')],
            'gender' => [Rule::enum(Gender::class)],
            'phone_number' => [
                'string',
                'min:10',
                'max:15',
                Rule::unique(Employee::class)->ignore($this->route('employee')),
            ],
            'village_code' => 'string|size:10',
            'district_code' => 'string|size:6',
            'city_code' => 'string|size:4',
            'province_code' => 'string|size:2',
        ];
    }

    public function messages()
    {
        return [
            'nip.prohibited' => ':attribute is unauthorized',
            'nik.prohibited' => ':attribute is unauthorized',
            'employee_name.prohibited' => ':attribute is unauthorized',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->sendError(
                message: "The given data was invalid",
                code: 422,
                errors: $validator->errors()->toArray()
            )
        );
    }

}