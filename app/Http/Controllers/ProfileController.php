<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Bahagian;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Papar form profil pengguna.
     */
    public function edit(Request $request): View
    {
        return view('pages.profile', [
            'user' => $request->user(),
            'bahagians' => Bahagian::orderBy('nama_bahagian')->get(),
        ]);
    }

    /**
     * Kemaskini profil pengguna.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        User::where('id', $request->user()->id)->update($request->validated());

        return back()->with('success', 'Profil berjaya dikemaskini.');
    }
}
