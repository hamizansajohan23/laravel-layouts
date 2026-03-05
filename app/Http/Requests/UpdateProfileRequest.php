<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'nokp' => ['nullable', 'string', 'size:12', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'bahagian_id' => ['nullable', 'exists:bahagians,id'],
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
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh melebihi 255 aksara.',
            'nokp.size' => 'No. KP mestilah 12 digit.',
            'nokp.regex' => 'No. KP hanya boleh mengandungi nombor.',
            'email.required' => 'Emel wajib diisi.',
            'email.email' => 'Format emel tidak sah.',
            'email.unique' => 'Emel ini telah digunakan.',
            'bahagian_id.exists' => 'Bahagian yang dipilih tidak sah.',
        ];
    }
}
