<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermohonanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'nokp' => ['required', 'string', 'size:12', 'regex:/^[0-9]+$/', 'unique:permohonans,nokp', 'unique:users,nokp'],
            'emel' => ['required', 'email', 'max:255', 'unique:permohonans,emel', 'unique:users,email'],
            'bahagian_id' => ['required', 'exists:bahagians,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh melebihi 255 aksara.',
            'nokp.required' => 'No. KP wajib diisi.',
            'nokp.size' => 'No. KP mestilah 12 digit.',
            'nokp.regex' => 'No. KP hanya boleh mengandungi nombor.',
            'nokp.unique' => 'No. KP ini telah wujud dalam sistem.',
            'emel.required' => 'Emel wajib diisi.',
            'emel.email' => 'Format emel tidak sah.',
            'emel.unique' => 'Emel ini telah wujud dalam sistem.',
            'bahagian_id.required' => 'Bahagian wajib dipilih.',
            'bahagian_id.exists' => 'Bahagian yang dipilih tidak sah.',
        ];
    }
}
