<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahagian;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    /**
     * Papar senarai pengguna.
     */
    public function index(): View
    {
        $users = User::with('bahagian')->latest()->paginate(10);

        return view('pages.admin.pengguna.index', compact('users'));
    }

    /**
     * Papar borang cipta pengguna baru.
     */
    public function create(): View
    {
        $bahagians = Bahagian::orderBy('nama_pendek')->get();

        return view('pages.admin.pengguna.create', compact('bahagians'));
    }

    /**
     * Simpan pengguna baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nokp' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'bahagian_id' => ['required', 'exists:bahagians,id'],
            'role' => ['required', 'in:admin,pengguna'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama penuh diperlukan.',
            'email.required' => 'Emel diperlukan.',
            'email.email' => 'Format emel tidak sah.',
            'email.unique' => 'Emel ini telah digunakan.',
            'bahagian_id.required' => 'Sila pilih bahagian.',
            'bahagian_id.exists' => 'Bahagian tidak sah.',
            'role.required' => 'Sila pilih peranan.',
            'status.required' => 'Sila pilih status.',
            'password.required' => 'Kata laluan diperlukan.',
            'password.min' => 'Kata laluan mestilah sekurang-kurangnya 8 aksara.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.',
        ]);

        User::create([
            'name' => $validated['name'],
            'nokp' => $validated['nokp'],
            'email' => $validated['email'],
            'bahagian_id' => $validated['bahagian_id'],
            'role' => $validated['role'],
            'status' => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna baru berjaya dicipta.');
    }

    /**
     * Papar borang kemaskini pengguna.
     */
    public function edit(User $pengguna): View
    {
        $bahagians = Bahagian::orderBy('nama_pendek')->get();

        return view('pages.admin.pengguna.edit', compact('pengguna', 'bahagians'));
    }

    /**
     * Kemaskini maklumat pengguna.
     */
    public function update(Request $request, User $pengguna): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nokp' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($pengguna->id)],
            'bahagian_id' => ['required', 'exists:bahagians,id'],
            'role' => ['required', 'in:admin,pengguna'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama penuh diperlukan.',
            'email.required' => 'Emel diperlukan.',
            'email.email' => 'Format emel tidak sah.',
            'email.unique' => 'Emel ini telah digunakan.',
            'bahagian_id.required' => 'Sila pilih bahagian.',
            'bahagian_id.exists' => 'Bahagian tidak sah.',
            'role.required' => 'Sila pilih peranan.',
            'status.required' => 'Sila pilih status.',
            'password.min' => 'Kata laluan mestilah sekurang-kurangnya 8 aksara.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'nokp' => $validated['nokp'],
            'email' => $validated['email'],
            'bahagian_id' => $validated['bahagian_id'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ];

        // Kemaskini kata laluan jika diisi
        if (! empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $pengguna->update($updateData);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Maklumat pengguna berjaya dikemaskini.');
    }

    /**
     * Padam pengguna.
     */
    public function destroy(User $pengguna): RedirectResponse
    {
        // Tidak boleh padam diri sendiri
        if ($pengguna->id === auth()?->user()?->id) {
            return redirect()
                ->route('admin.pengguna.index')
                ->with('error', 'Anda tidak boleh memadam akaun anda sendiri.');
        }

        $pengguna->delete();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Pengguna berjaya dipadam.');
    }
}
