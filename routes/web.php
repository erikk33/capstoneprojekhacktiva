<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\userController;
use App\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect('/register');
});



// Rute untuk menampilkan form registrasi
Route::get('/register', [userController::class, 'viewPageRegister'])->name('register');
// Rute untuk memproses data registrasi
Route::post('/register', [userController::class, 'sendUserData']);

// --- RUTE BARU UNTUK VERIFIKASI ---
// Rute untuk halaman pemberitahuan "Cek email Anda"
Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');

// Rute untuk menangani link verifikasi dari email
Route::get('/verify/{token}', [VerificationController::class, 'verify'])->name('verification.verify');
















// Menampilkan halaman form unggah
Route::get('/home', [IdentificationController::class, 'showUploadForm'])
    ->name('identification.form');

// Memproses data dari form unggah
Route::post('/identifikasi', [IdentificationController::class, 'processImage'])
    ->name('identification.process');
