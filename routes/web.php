<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\userController;

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
    return redirect('/users/register');
});



Route::get('/users/register',[userController::class,'viewPageRegister'])->name('viewRegisterPage');



















// Menampilkan halaman form unggah
Route::get('/home', [IdentificationController::class, 'showUploadForm'])
    ->name('identification.form');

// Memproses data dari form unggah
Route::post('/identifikasi', [IdentificationController::class, 'processImage'])
    ->name('identification.process');
