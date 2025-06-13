<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\SendVerificationEmail; // <-- 1. Import Mailable
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;   // <-- 2. Import Mail Facade
use Illuminate\Support\Str;         // <-- 3. Import Str untuk membuat token
use Illuminate\Http\RedirectResponse;

class userController extends Controller
{
    public function viewPageRegister() {
        return view('usersRegister');
    }

    public function sendUserData(Request $request): RedirectResponse
    {
        // Validasi input (sedikit disempurnakan agar berfungsi dengan benar)
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'fullName' => 'required|string',
            'birth' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Siapkan data untuk dimasukkan ke database
        $userData = [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'fullName' => $request->fullName,
            'birth' => $request->birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_token' => Str::random(60), // Buat token verifikasi
        ];

        // Cek dan proses jika ada foto profil yang diunggah
        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $userData['profile_photo_path'] = $path;
        }

        // Buat user baru dan simpan ke variabel
        $user = User::create($userData);

        // Kirim email verifikasi ke pengguna yang baru dibuat
        Mail::to($user->email)->send(new SendVerificationEmail($user));

        // Arahkan ke halaman pemberitahuan "Cek email Anda"
        return redirect()->route('verification.notice')
            ->with('status', 'Registrasi berhasil! Silakan periksa email Anda untuk memverifikasi akun Anda.');
    }
}
