<?php

namespace App\Http\Requests;

use App\Enums\ChangeRequestStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'header_content_type' => $this->header('Content-Type'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'header_content_type' => 'required|in:application/json',

            'field_name' => 'required|string|max:255',
            'old_value' => 'required|string|max:255',
            'new_value' => 'required|string',
        ];
    }
}
