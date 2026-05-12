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
            'class_session' => ['required', 'array', 'min:14', 'max:16'],

            'class_session.*.pengampu_id' => ['required', 'string', 'max:36'],
            'class_session.*.lecturer_id' => ['required', 'string', 'max:36'],
            'class_session.*.course_name' => ['required', 'string', 'max:255'],
            'class_session.*.class_id' => ['required', 'string', 'max:36'],
            'class_session.*.session_amount' => ['required', 'integer', 'max:16'],
            'class_session.*.start_date' => ['required', Rule::date()->format('d-m-Y')],
            'class_session.*.start_time' => ['required',Rule::date()->format('H-i')],
            'class_session.*.end_time' => ['required',Rule::date()->format('H-i')],
        ];
    }
}
