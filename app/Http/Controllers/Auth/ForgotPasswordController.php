<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /**
     * Papar form lupa kata laluan.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Hantar link reset password ke emel.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Emel wajib diisi.',
            'email.email' => 'Format emel tidak sah.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Pautan untuk set semula kata laluan telah dihantar ke emel.');
        }

        throw ValidationException::withMessages([
            'email' => 'Emel tidak sah. Sila hubungi pentadbir sistem.',
        ]);
    }
}
