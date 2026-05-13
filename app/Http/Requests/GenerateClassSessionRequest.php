<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'pengampu_id' => ['required', 'string', 'max:36'],
            'lecturer_id' => ['required', 'string', 'max:36'],
            'class_id' => ['required', 'string', 'max:36'],
            'class_name' => ['required', 'string', 'max:255'],
            'course_name' => ['required', 'string', 'max:255'],
            'session_amount' => ['required', 'integer', 'max:16'],
            'start_time' => ['required', Rule::date()->format('H:i')],
            'end_time' => ['required', Rule::date()->format('H:i')],
        ];
    }
}
