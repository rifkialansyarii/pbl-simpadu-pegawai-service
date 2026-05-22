<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLearningMaterialRequest extends FormRequest
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
            'class_session_id' => ['required', 'string', 'size:36'],
            'learning_materials' => ['required', 'array', 'min:1'],
            'learning_materials.*' => ['required', 'mimes:pdf,jpg,jpeg,png,csv,xlsx', 'max:10240'],
        ];
    }
}
