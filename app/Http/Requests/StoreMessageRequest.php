<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();

        $this->merge([
            'sender_name' => $data['sender_name'] ?? $data['name'] ?? null,
            'sender_email' => $data['sender_email'] ?? $data['email'] ?? null,
            'subject' => $data['subject'] ?? null,
            'body' => $data['body'] ?? $data['message'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'sender_name' => ['required', 'string', 'min:3', 'max:100'],
            'sender_email' => ['required', 'email:rfc', 'max:255'],
            'subject' => ['required', 'string', 'min:3', 'max:150'],
            'body' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'sender_name.required' => 'Nama pengirim wajib diisi.',
            'sender_name.min' => 'Nama pengirim minimal terdiri dari :min karakter.',
            'sender_name.max' => 'Nama pengirim maksimal :max karakter.',
            'sender_email.required' => 'Alamat email pengirim wajib diisi.',
            'sender_email.email' => 'Format alamat email tidak valid.',
            'sender_email.max' => 'Alamat email maksimal :max karakter.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'subject.min' => 'Subjek pesan minimal terdiri dari :min karakter.',
            'subject.max' => 'Subjek pesan maksimal :max karakter.',
            'body.required' => 'Isi pesan wajib diisi.',
            'body.min' => 'Isi pesan terlalu pendek, minimal :min karakter agar maksud pesan jelas.',
            'body.max' => 'Isi pesan melebihi batas maksimal (:max karakter).',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validasi data gagal. Silakan periksa kembali form isian Anda.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
