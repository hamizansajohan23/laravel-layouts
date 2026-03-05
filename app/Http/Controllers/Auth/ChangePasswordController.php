<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ChangePasswordController extends Controller
{
    /**
     * Papar halaman tukar kata laluan.
     */
    public function edit(Request $request): View
    {
        return view('pages.change-password', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Kemaskini kata laluan pengguna.
     */
    public function update(ChangePasswordRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        return back()->with('success', 'Kata laluan berjaya ditukar.');
    }
}
