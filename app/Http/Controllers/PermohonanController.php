<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermohonanRequest;
use App\Http\Requests\UpdatePermohonanRequest;
use App\Models\Bahagian;
use App\Models\Permohonan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermohonanController extends Controller
{
    /**
     * Papar senarai permohonan pengguna.
     */
    public function index(Request $request): View
    {
        $permohonans = Permohonan::with('bahagian')
            ->where('pengguna_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('pages.permohonan.index', compact('permohonans'));
    }

    /**
     * Papar borang permohonan baru.
     */
    public function create(): View
    {
        $bahagians = Bahagian::orderBy('nama_bahagian')->get();

        return view('pages.permohonan.create', compact('bahagians'));
    }

    /**
     * Simpan permohonan baru.
     */
    public function store(StorePermohonanRequest $request): RedirectResponse
    {
        Permohonan::create([
            ...$request->validated(),
            'pengguna_id' => $request->user()->id,
            'status' => 'dalam_semakan',
        ]);

        return redirect()
            ->route('permohonan.index')
            ->with('success', 'Permohonan berjaya dihantar.');
    }

    /**
     * Papar maklumat permohonan.
     */
    public function show(Request $request, Permohonan $permohonan): View
    {
        // Pastikan pengguna hanya boleh lihat permohonan sendiri
        if ($permohonan->pengguna_id !== $request->user()->id) {
            abort(403);
        }

        return view('pages.permohonan.show', compact('permohonan'));
    }

    /**
     * Papar borang edit permohonan.
     */
    public function edit(Request $request, Permohonan $permohonan): View|RedirectResponse
    {
        // Pastikan pengguna hanya boleh edit permohonan sendiri
        if ($permohonan->pengguna_id !== $request->user()->id) {
            abort(403);
        }

        // Hanya boleh edit jika status masih dalam semakan
        if ($permohonan->status !== 'dalam_semakan') {
            return redirect()
                ->route('permohonan.index')
                ->with('error', 'Permohonan tidak boleh diedit kerana telah diproses.');
        }

        $bahagians = Bahagian::orderBy('nama_bahagian')->get();

        return view('pages.permohonan.edit', compact('permohonan', 'bahagians'));
    }

    /**
     * Kemaskini permohonan.
     */
    public function update(UpdatePermohonanRequest $request, Permohonan $permohonan): RedirectResponse
    {
        // Pastikan pengguna hanya boleh kemaskini permohonan sendiri
        if ($permohonan->pengguna_id !== $request->user()->id) {
            abort(403);
        }

        // Hanya boleh kemaskini jika status masih dalam semakan
        if ($permohonan->status !== 'dalam_semakan') {
            return redirect()
                ->route('permohonan.index')
                ->with('error', 'Permohonan tidak boleh dikemaskini kerana telah diproses.');
        }

        $permohonan->update($request->validated());

        return redirect()
            ->route('permohonan.index')
            ->with('success', 'Permohonan berjaya dikemaskini.');
    }

    /**
     * Padam permohonan.
     */
    public function destroy(Request $request, Permohonan $permohonan): RedirectResponse
    {
        // Pastikan pengguna hanya boleh padam permohonan sendiri
        if ($permohonan->pengguna_id !== $request->user()->id) {
            abort(403);
        }

        // Hanya boleh padam jika status masih dalam semakan
        if ($permohonan->status !== 'dalam_semakan') {
            return redirect()
                ->route('permohonan.index')
                ->with('error', 'Permohonan tidak boleh dipadam kerana telah diproses.');
        }

        $permohonan->delete();

        return redirect()
            ->route('permohonan.index')
            ->with('success', 'Permohonan berjaya dipadam.');
    }
}
