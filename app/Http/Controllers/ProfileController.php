<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Bahagian;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $user = $request->user();
        $data = $request->validated();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $data['profile_picture'] = $path;
        }

        // For regular users (pengguna), only allow name and email updates
        if ($user->role === 'user' || $user->role === 'pengguna') {
            $data = array_intersect_key($data, array_flip(['name', 'email', 'profile_picture']));
        }

        User::where('id', $user->id)->update($data);

        return back()->with('success', 'Profil berjaya dikemaskini.');
    }
}
