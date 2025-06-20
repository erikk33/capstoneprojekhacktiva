<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserShopController;
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

//rute untuk login masih tahap konfigurasi backend
// Rute untuk menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses data login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

//  pengelompokan rute admin
Route::middleware(['auth', 'admin'])->group(function () {

    // Semua rute di dalam grup ini akan dilindungi.
    // Hanya user dengan email 'erikxzc@gmail.com' yang bisa mengakses.
    Route::get('/admin/dashboard', function () {
        return view('adminMainPage.adminHomePage');
    })->name('admin.dashboard');
    Route::get('/admin/dashboard', [ProductController::class, 'showAdminPage'])->name('admin.dashboard');
    //produk routes
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    // Di dalam grup admin
    Route::put('/admin/products/update', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/destroy', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Kategori routes
    Route::post('/admin/category', [ProductController::class, 'simpanCategory'])
        ->name('admin.categories.store');

    Route::put('/admin/categories/update', [ProductController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/admin/categories/destroy', [ProductController::class, 'destroyCategory'])->name('admin.categories.destroy');
    // Route::get('/admin/products', [AdminProductController::class, 'index']);
    // Route::get('/admin/users', [AdminUserController::class, 'index']);
});

//rute untuk pengguna biasa
Route::middleware(['auth'])->group(function () {

    //rute testing halaman homepage user (MASIH PROSES PENGEMBANGAN)
    Route::get('/user/home', [UserHomeController::class, 'index'])->name('dashboard');

    Route::view('/user/about', 'userMainPage.userAboutPage')->name('dashboard-about');

     // Cart routes
     Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
     Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
     Route::post('/cart/remove/{index}', [CartController::class, 'removeFromCart'])->name('cart.remove');
     Route::get('/user/shop', [UserShopController::class, 'index'])->name('shop');

     // Checkout routes
     Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');


});


// Rute logout sudah ada di file Anda:
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

















// Menampilkan halaman form unggah
// Route::get('/home', [IdentificationController::class, 'showUploadForm'])
//     ->name('identification.form');

// // Memproses data dari form unggah
// Route::post('/identifikasi', [IdentificationController::class, 'processImage'])
//     ->name('identification.process');
