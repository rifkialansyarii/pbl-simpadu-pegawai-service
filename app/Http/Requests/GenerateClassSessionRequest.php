<?php

namespace App\Http\Requests;

use App\Rules\CourseQuotaLimit;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Knuckles\Scribe\Attributes\BodyParam;

#[BodyParam("pengampu_id", "string", "ID table Pengampu (service 1), harus UUID", example: "123e4567-e89b-12d3-a456-426614174000", required: true)]
#[BodyParam("lecturer_id", "string", "ID pegawai dengan role dosen, harus UUID", example: "123e4567-e89b-12d3-a456-426614174000", required: true)]
#[BodyParam("class_id", "string", "ID kelas (service 1), harus UUID", example: "123e4567-e89b-12d3-a456-426614174000", required: true)]
#[BodyParam("class_name", "string", "Nama Kelas", example: "TI-4A", required: true)]
#[BodyParam("course_code", "string", "Kode Mata Kuliah", example: "MK001", required: true)]
#[BodyParam("course_name", "string", "Nama Mata Kuliah", example: "Pemrograman Web", required: true)]
#[BodyParam("start_date", "string", "Tanggal dimulainya perkuliahan", example: "1990-01-01", required: true)]
#[BodyParam("start_time", "string", "Waktu dimulainya perkuliahan", example: "08:30", required: true)]
#[BodyParam("end_time", "string", "Waktu selesainya perkuliahan", example: "10:30", required: true)]
class GenerateClassSessionRequest extends FormRequest
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
            'pengampu_id' => ['required', 'string', 'size:36'],
            'lecturer_id' => ['required', 'string', 'size:36'],
            'class_id' => ['required', 'string', 'size:36'],
            'class_name' => ['required', 'string', 'max:255'],
            'course_code' => ['required', 'string', 'size:5'],
            'course_name' => [
                'required',
                'string',
                'max:255',
                new CourseQuotaLimit($this->class_id, $this->class_name, $this->course_code),
            ],
            'start_date' => ['required', Rule::date()->format('Y-m-d')],
            'start_time' => ['required', Rule::date()->format('H:i')],
            'end_time' => ['required', Rule::date()->format('H:i')],
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
