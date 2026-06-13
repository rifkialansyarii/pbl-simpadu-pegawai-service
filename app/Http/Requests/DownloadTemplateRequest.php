<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DownloadTemplateRequest extends FormRequest
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
            'students' => ['required', 'array', 'min:1'],
            'students.*.student_id' => ['required', 'string', 'size:36'],
            'students.*.nim' => ['required', 'string', 'max:10'],
            'students.*.name' => ['required', 'string', 'max:255'],
            'course_code' => ['required', 'string', 'max:10'],
            'course_name' => ['required', 'string', 'max:255'],
            'class_id' => ['required', 'string', 'size:36'],
            'class_name' => ['required', 'string', 'max:255'],
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
