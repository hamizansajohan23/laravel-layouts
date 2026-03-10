<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\RegistrationApprovedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    /**
     * Papar senarai permohonan pendaftaran (status = baru dan belum diluluskan).
     */
    public function index(): View
    {
        $pendaftarans = User::with('bahagian')
            ->where('status', 'baru')
            ->whereNull('email_verified_at') // Belum diluluskan
            ->latest()
            ->paginate(10);

        return view('pages.admin.pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Luluskan permohonan pendaftaran.
     */
    public function approve(User $user): RedirectResponse
    {
        if ($user->status !== 'baru' || $user->email_verified_at !== null) {
            return redirect()
                ->route('admin.pendaftaran.index')
                ->with('error', 'Permohonan ini telah diproses.');
        }

        // Set email_verified_at as approval timestamp, keep status as 'baru' (new staff)
        $user->update(['email_verified_at' => now()]);

        // Hantar notifikasi kelulusan
        $user->notify(new RegistrationApprovedNotification);

        return redirect()
            ->route('admin.pendaftaran.index')
            ->with('success', 'Pendaftaran '.$user->name.' telah diluluskan.');
    }

    /**
     * Tolak permohonan pendaftaran.
     */
    public function reject(User $user): RedirectResponse
    {
        if ($user->status !== 'baru' || $user->email_verified_at !== null) {
            return redirect()
                ->route('admin.pendaftaran.index')
                ->with('error', 'Permohonan ini telah diproses.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()
            ->route('admin.pendaftaran.index')
            ->with('success', 'Pendaftaran '.$userName.' telah ditolak dan dipadam.');
    }
}
