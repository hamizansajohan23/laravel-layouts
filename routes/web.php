<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Password Reset Routes
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $user = auth()->user();
        $isAdmin = strtolower($user->role) === 'admin';

        // Statistik untuk dashboard (admin sahaja)
        $stats = [];
        $chartData = [];
        $permohonanTerkini = collect();

        if ($isAdmin) {
            $stats = [
                'jumlah_pengguna' => User::count(),
                'pengguna_aktif' => User::where('status', 'aktif')->count(),
                'pengguna_tidak_aktif' => User::where('status', 'tidak_aktif')->count(),
            ];

            // Data untuk graf bulanan (6 bulan terakhir)
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $chartData['labels'][] = $date->translatedFormat('M');
                $chartData['pengguna'][] = User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
            }
        }

        return view('pages.dashboard', compact('stats', 'chartData', 'isAdmin'));
    })->name('dashboard');

    // Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Tukar Kata Laluan
    Route::get('/change-password', [ChangePasswordController::class, 'edit'])->name('password.change');
    Route::put('/change-password', [ChangePasswordController::class, 'update'])->name('password.change.update');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Senarai Pengguna (untuk admin)
        Route::get('/pengguna', [App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('pengguna.index');
        Route::get('/pengguna/create', [App\Http\Controllers\Admin\PenggunaController::class, 'create'])->name('pengguna.create');
        Route::post('/pengguna', [App\Http\Controllers\Admin\PenggunaController::class, 'store'])->name('pengguna.store');
        Route::get('/pengguna/{pengguna}/edit', [App\Http\Controllers\Admin\PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('/pengguna/{pengguna}', [App\Http\Controllers\Admin\PenggunaController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{pengguna}', [App\Http\Controllers\Admin\PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    });
});
