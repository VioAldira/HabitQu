<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
        public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home'); // ganti dengan route dashboard kamu
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
    public function logout(Request $request)
    {
        // 1. Menghapus informasi autentikasi dari session user
        Auth::logout();

        // 2. Membuat session yang lama menjadi tidak valid
        $request->session()->invalidate();

        // 3. Membuat ulang token CSRF untuk keamanan
        $request->session()->regenerateToken();

        // 4. Mengarahkan user kembali ke halaman login
        return redirect('/login');
    }
}
