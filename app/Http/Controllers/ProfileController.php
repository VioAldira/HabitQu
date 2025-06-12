<?php
// File: app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function show()
    {
        // Mengambil data user yang sedang login dan menampilkannya di view
        return view('profile.show', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna (nama dan email).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Pastikan email unik, tapi abaikan email user saat ini
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('status', 'profile-updated');
    }

    /**
     * Memperbarui kata sandi pengguna.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            // 'current_password' akan otomatis dicek oleh Laravel apakah cocok dengan password saat ini
            'current_password' => ['required', 'current_password'],
            // Validasi untuk password baru: wajib, minimal 8 karakter, dan harus sama dengan konfirmasinya
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}