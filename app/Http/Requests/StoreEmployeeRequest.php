<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Knuckles\Scribe\Attributes\BodyParam;

#[BodyParam("nip", "string", "NIP harus unik dan terdiri dari 18 karakter", example: "691651594659009703", required: true)]
#[BodyParam("nik", "string", "NIK harus unik dan terdiri dari 16 karakter", example: "1801160204072477", required: true)]
#[BodyParam("employee_name", "string", "Nama pegawai harus diisi", example: "John Doe", required: true)]
#[BodyParam("study_program_id", "integer", "ID Program Studi", example: "1", required: false)]
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
class StoreEmployeeRequest extends FormRequest
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
            'nip' => 'required|string|unique:App\Models\Employee,nip|size:18',
            'nik' => 'required|string|unique:App\Models\Employee,nik|size:16',
            'employee_name' => 'required|string|max:255',
            'study_program_id' => 'string|size:36',
            'study_program_name' => 'string|max:255',
            'address' => 'string|max:255',
            'birth_place' => 'string|max:255',
            'birth_date' => [Rule::date()->format('Y-m-d')],
            'gender' => [Rule::enum(Gender::class)],
            'phone_number' => 'string|min:10|max:15|unique:App\Models\Employee,phone_number',
            'village_code' => 'string|size:10',
            'district_code' => 'string|size:6',
            'city_code' => 'string|size:4',
            'province_code' => 'string|size:2',
            'citizen_code' => 'string|size:2|sometimes',
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
            ], 422)
        );
    }
}