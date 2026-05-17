<?php

namespace App\Http\Requests;

use App\Enums\ClassSessionStatus;
use App\Models\ClassSession;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateClassSessionRequest extends FormRequest
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
            'topic' => ['string', 'max:255'],
            'session_date' => [Rule::date()->format('Y-m-d')],
            'start_time' => [Rule::date()->format('H:i')],
            'end_time' => [Rule::date()->format('H:i')],
            'status' => [Rule::enum(ClassSessionStatus::class)]
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
