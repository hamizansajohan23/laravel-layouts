<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Papar halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Semak jika pengguna masih menunggu kelulusan (baru + belum diluluskan)
            if ($user->isPendingApproval()) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'nokp' => 'Akaun anda masih menunggu kelulusan admin.',
                ]);
            }

            if ($user->status === 'tidak_aktif') {
                Auth::logout();
                throw ValidationException::withMessages([
                    'nokp' => 'Akaun anda telah dinyahaktifkan. Sila hubungi admin.',
                ]);
            }

            $request->session()->regenerate();

            // Clear intended URL and always redirect to dashboard
            $request->session()->forget('url.intended');

            return redirect()->route('dashboard');
        }

        throw ValidationException::withMessages([
            'nokp' => 'No. Kad Pengenalan atau kata laluan tidak sah.',
        ]);
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
