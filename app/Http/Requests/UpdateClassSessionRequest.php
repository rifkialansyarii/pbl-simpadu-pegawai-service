<?php

namespace App\Http\Requests;

use App\Enums\ClassSessionStatus;
use App\Models\ClassSession;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Knuckles\Scribe\Attributes\BodyParam;

#[BodyParam("topic", "string", "Topik yang dibahas pada sesi kelas", example: "Session 1 - Mahasiswa mampu memahami konsep MVC", required: false)]
#[BodyParam("session_date", "string", "Tanggal perkuliahan", example: "1990-01-01", required: false)]
#[BodyParam("start_time", "string", "Waktu dimulainya perkuliahan", example: "08:30", required: false)]
#[BodyParam("end_time", "string", "Waktu selesainya perkuliahan", example: "10:30", required: false)]
#[BodyParam("status", "string", "Status sesi kelas (opened / closed), khusus role dosen yang bisa update", example: "opened", required: false)]
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
        $rules = array();
        $role = $this->user()->role ?? null;

        if ($role === 'super-admin' || $role === 'admin-pegawai') {
            $rules = [
                'topic' => ['string', 'max:255'],
                'session_date' => [Rule::date()->format('Y-m-d')],
                'start_time' => [Rule::date()->format('H:i')],
                'end_time' => [Rule::date()->format('H:i')],
            ];
        }

        if($role === 'dosen') {
            $rules = [
                'status' => [Rule::enum(ClassSessionStatus::class)]
            ];
        }

        return $rules;
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
