<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Bahagian;
use App\Models\User;
use App\Notifications\NewRegistrationNotification;
use App\Notifications\RegistrationSubmittedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm(): View
    {
        $bahagians = Bahagian::orderBy('nama_bahagian')->get();

        return view('auth.register', compact('bahagians'));
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nokp' => ['required', 'string', 'size:12', 'unique:users,nokp'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'bahagian_id' => ['required', 'exists:bahagians,id'],
            'password' => [
                'required',
                'string',
                'min:12',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ], [
            'name.required' => 'Sila masukkan nama penuh.',
            'nokp.required' => 'Sila masukkan No. Kad Pengenalan.',
            'nokp.size' => 'No. Kad Pengenalan mestilah 12 digit.',
            'nokp.unique' => 'No. Kad Pengenalan ini telah didaftarkan.',
            'email.required' => 'Sila masukkan alamat emel.',
            'email.email' => 'Format emel tidak sah.',
            'email.unique' => 'Emel ini telah didaftarkan.',
            'bahagian_id.required' => 'Sila pilih bahagian.',
            'bahagian_id.exists' => 'Bahagian tidak sah.',
            'password.required' => 'Sila masukkan kata laluan.',
            'password.min' => 'Kata laluan mestilah sekurang-kurangnya 12 aksara.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.',
            'password.regex' => 'Kata laluan tidak memenuhi keperluan keselamatan.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nokp' => $request->nokp,
            'email' => $request->email,
            'bahagian_id' => $request->bahagian_id,
            'password' => Hash::make($request->password),
            'role' => 'pengguna',
            'status' => 'baru',
        ]);

        // Send notification to user about successful registration submission
        $user->notify(new RegistrationSubmittedNotification);

        // Notify all admins about new registration
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewRegistrationNotification($user));

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berjaya dihantar! Sila tunggu kelulusan daripada pentadbir. Anda akan menerima emel setelah akaun anda diluluskan.');
    }
}
