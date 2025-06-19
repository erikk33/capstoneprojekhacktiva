<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Menangani upaya otentikasi (login) pengguna.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // 1. Validasi input dari form login.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek apakah pengguna mencentang "Remember Me".
        $remember = $request->boolean('remember');

        // 3. Mencoba untuk mengotentikasi pengguna.
        if (Auth::attempt($credentials, $remember)) {

            // Regenerate session untuk keamanan.
            $request->session()->regenerate();

            // === PERUBAHAN UTAMA: Cek Email Pengguna ===
            // Dapatkan pengguna yang baru saja login.
            $user = Auth::user();

            // Cek apakah email pengguna adalah email admin.
            if ($user->email === 'erikxzc@gmail.com') {
                // Jika ya, arahkan ke dashboard admin.
                return redirect()->intended('/admin/dashboard')
                    ->with('success', 'Welcome back, Admin!');
            }

            // Jika bukan admin, arahkan ke dashboard pengguna biasa.
            return redirect()->intended('/user/home')
                ->with('success', 'You have successfully logged in!');
        }

        // 4. Jika otentikasi gagal.
        return back()->withErrors([
            'email' => 'credential yang anda input sebelumnya tidak sesuai',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout pengguna.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
