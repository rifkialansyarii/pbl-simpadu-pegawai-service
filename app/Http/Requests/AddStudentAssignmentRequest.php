<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Knuckles\Scribe\Attributes\BodyParam;

#[BodyParam(name: 'file_uuids', type: 'string[]', description: 'Masukkan file uuids yang ingin digunakan sebagai tugas', example: ['019e33e7-993d-7376-9c5a-c3c8078d697b', '019e33e7-993d-7376-9c5a-c3c8078d697b'])]
#[BodyParam(name: 'title', type: 'string', description: 'Masukkan judul tugas', example: 'Tugas 1')]
#[BodyParam(name: 'description', type: 'string', description: 'Masukkan deskripsi tugas', example: 'Deskripsi tugas 1')]
#[BodyParam(name: 'deadline', type: 'string', description: 'Masukkan tanggal deadline tugas', example: '2023-12-31')]
class AddStudentAssignmentRequest extends FormRequest
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
            "file_uuids" => ['array', 'required', 'min:1'],
            "file_uuids.*" => [
                'required',
                'string',
                'size:36',
                Rule::exists('file_uploads', 'id'),
            ],
            "title" => ['string', 'required', 'max:255'],
            "description" => ['string', 'required', 'max:255'],
            'deadline' => ['required', Rule::date()->format('Y-m-d')],
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
