<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Knuckles\Scribe\Attributes\QueryParam;

#[QueryParam("page", "status", "Filter berdasarakan status verifikasi, required: false")]
#[QueryParam("page", "search", "Pencarian berdasarkan nip, nik, nama, required: false")]
class FilterChangeRequest extends FormRequest
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
            'status' => ['sometimes', 'string', 'exists:change_requests,status', 'max:20'],
            'search' => ['sometimes', 'string', 'max:30'],
        ];
    }

    public function queryParameters()
    {
        return [
            'status' => [
                'description' => 'Filter by status',
                'example' => 'approved',
            ],
            'search' => [
                'description' => 'Search by nip, nik, nama',
                'example' => 'john doe',
            ],
        ];
    }
}
