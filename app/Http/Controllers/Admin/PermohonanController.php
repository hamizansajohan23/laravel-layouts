<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PermohonanController extends Controller
{
    /**
     * Papar senarai semua permohonan.
     */
    public function index(Request $request): View
    {
        $query = Permohonan::with(['bahagian', 'pengguna'])->latest();

        // Filter mengikut status - default kepada dalam_semakan
        $status = $request->input('status', 'dalam_semakan');
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        $permohonans = $query->paginate(10);

        return view('pages.admin.permohonan.index', compact('permohonans', 'status'));
    }

    /**
     * Papar maklumat permohonan.
     */
    public function show(Permohonan $permohonan): View
    {
        $permohonan->load(['bahagian', 'pengguna']);

        return view('pages.admin.permohonan.show', compact('permohonan'));
    }

    /**
     * Luluskan permohonan dan cipta akaun pengguna baru.
     */
    public function approve(Request $request, Permohonan $permohonan): RedirectResponse
    {
        if ($permohonan->status !== 'dalam_semakan') {
            return redirect()
                ->route('admin.permohonan.index')
                ->with('error', 'Permohonan ini telah diproses sebelum ini.');
        }

        // Cipta akaun pengguna baru
        User::create([
            'name' => $permohonan->nama,
            'nokp' => $permohonan->nokp,
            'email' => $permohonan->emel,
            'password' => Hash::make('password123'), // Default password
            'role' => 'pengguna',
            'status' => 'aktif',
            'bahagian_id' => $permohonan->bahagian_id,
        ]);

        // Kemaskini status permohonan
        $permohonan->update([
            'status' => 'diluluskan',
            'catatan' => $request->input('catatan'),
            'tarikh_keputusan' => now(),
        ]);

        return redirect()
            ->route('admin.permohonan.index')
            ->with('success', 'Permohonan telah diluluskan dan akaun pengguna berjaya dicipta.');
    }

    /**
     * Tolak permohonan.
     */
    public function reject(Request $request, Permohonan $permohonan): RedirectResponse
    {
        if ($permohonan->status !== 'dalam_semakan') {
            return redirect()
                ->route('admin.permohonan.index')
                ->with('error', 'Permohonan ini telah diproses sebelum ini.');
        }

        $request->validate([
            'catatan' => ['required', 'string', 'max:500'],
        ], [
            'catatan.required' => 'Sila masukkan sebab penolakan.',
        ]);

        $permohonan->update([
            'status' => 'ditolak',
            'catatan' => $request->input('catatan'),
            'tarikh_keputusan' => now(),
        ]);

        return redirect()
            ->route('admin.permohonan.index')
            ->with('success', 'Permohonan telah ditolak.');
    }
}
