<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string', 'current_password'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(12)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'regex:/[@$!%*?&]/',
            ],
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
            'current_password.required' => 'Kata laluan semasa wajib diisi.',
            'current_password.current_password' => 'Kata laluan semasa tidak tepat.',
            'password.required' => 'Kata laluan baru wajib diisi.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.',
            'password.min' => 'Kata laluan mesti sekurang-kurangnya 12 aksara.',
            'password.regex' => 'Kata laluan mesti mengandungi sekurang-kurangnya satu aksara khas (@$!%*?&).',
        ];
    }
}
