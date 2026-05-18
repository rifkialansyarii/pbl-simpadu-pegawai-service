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
use Knuckles\Scribe\Attributes\BodyParam;

#[BodyParam("nip", "string", "NIP harus unik dan terdiri dari 18 karakter (Perubahan pada field ini akan berlaku jika admin menyetujui)", example: "691651594659009703", required: false)]
#[BodyParam("nik", "string", "NIK harus unik dan terdiri dari 16 karakter (Perubahan pada field ini akan berlaku jika admin menyetujui)", example: "1801160204072477", required: false)]
#[BodyParam("employee_name", "string", "Nama pegawai (Perubahan pada field ini akan berlaku jika admin menyetujui)", example: "John Doe", required: false)]
#[BodyParam("study_program_id", "string", "UUID Program Studi", example: "123e4567-e89b-12d3-a456-426614174000", required: false)]
#[BodyParam("study_program_name", "string", "Nama Program Studi", example: "teknik-listrik", required: false)]
#[BodyParam("address", "string", "Alamat Pegawai", example: "Gg. Casablanca No. 249, Administrasi Jakarta Timur 83230, Sulteng", required: false)]
#[BodyParam("birth_place", "string", "Tempat lahir", example: "Jakarta", required: false)]
#[BodyParam("birth_date", "string", "Tanggal lahir", example: "1990-01-01", required: false)]
#[BodyParam("gender", "string", "Jenis kelamin", example: "laki-laki, perempuan", required: false)]
#[BodyParam("phone_number", "string", "Nomor telepon harus unik", example: "081234567890", required: false)]
#[BodyParam("village_code", "string", "Kode desa / kelurahan", example: "1111082017", required: false)]
#[BodyParam("district_code", "string", "Kode kecamatan", example: "1111082", required: false)]
#[BodyParam("city_code", "string", "Kode kota", example: "111108", required: false)]
#[BodyParam("province_code", "string", "Kode provinsi", example: "11", required: false)]
#[BodyParam("citizen_code", "string", "Kode warga negara", example: "ID", required: false)]
class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'nip' => [
                'string',
                'size:18',
                Rule::unique(Employee::class)->ignore($this->route('employee')),
            ],
            'nik' => [
                'string',
                'size:16',
                Rule::unique(Employee::class)->ignore($this->route('employee')),
            ],
            'employee_name' => 'string|max:255',
            'study_program_id' => 'string|size:36',
            'study_program_name' => 'string|max:255',
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
            'citizen_code' => 'string|size:2,'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => "The given data was invalid",
                'code' => 422,
                'errors' => $validator->errors()->toArray()
            ])
        );
    }

}