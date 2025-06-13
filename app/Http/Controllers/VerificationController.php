<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon; // Untuk menandai waktu verifikasi

class VerificationController extends Controller
{
    /**
     * Menampilkan halaman pemberitahuan setelah registrasi.
     */
    public function notice()
    {
        return view('auth.verification-notice');
    }

    /**
     * Memproses link verifikasi dari email.
     */
    public function verify($token)
    {
        // Cari pengguna dengan token yang cocok
        $user = User::where('verification_token', $token)->first();

        // Jika tidak ditemukan atau sudah diverifikasi, tampilkan error
        if (!$user || $user->email_verified_at) {
            return redirect('/login')->with('error', 'Link verifikasi tidak valid atau sudah kedaluwarsa.');
        }

        // Jika ditemukan, update status verifikasinya
        $user->email_verified_at = Carbon::now();
        $user->verification_token = null; // Hapus token setelah digunakan
        $user->save();

        // Arahkan ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Akun Anda berhasil diverifikasi! Silakan login.');
    }
}
