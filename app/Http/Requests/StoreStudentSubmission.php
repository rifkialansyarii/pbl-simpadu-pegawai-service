<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Knuckles\Scribe\Attributes\BodyParam;

#[BodyParam(name: 'file_uuids', type: 'string[]', description: 'Masukkan file uuids yang ingin disubmit sebagai tugas', example: ['019e33e7-993d-7376-9c5a-c3c8078d697b', '019e33e7-993d-7376-9c5a-c3c8078d697b'])]
class StoreStudentSubmission extends FormRequest
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
                Rule::exists('file_uploads', 'id')->where(function (Builder $query) {
                    return $query->where('user_id', $this->user()->id);
                }),
            ],
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
