<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Knuckles\Scribe\Attributes\BodyParam;

#[BodyParam(name: 'file_uuids', type: 'string[]', description: 'Masukkan uuids file materi yang ingin dihapus', example: ['019e33e7-993d-7376-9c5a-c3c8078d697b', '019e33e7-993d-7376-9c5a-c3c8078d697b'])]
class DeleteLearningMaterialRequest extends FormRequest
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
            "file_uuids.*" => ['required', 'string', Rule::exists('file_uploads', 'id'), 'size:36']
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
