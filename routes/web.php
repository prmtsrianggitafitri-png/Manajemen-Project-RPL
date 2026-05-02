<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrestasiController; // Pindahkan ke atas agar rapi
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mahasiswa Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // FITUR PRESTASI (Gabungan Upload & Hapus)
    Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
    Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
    
    // BAGIAN KAMU: Route Hapus Prestasi
    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Belum login
    Route::middleware('guest:admin')->group(function () {
        Route::get('/loginAdmin', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/loginAdmin', [AdminAuthController::class, 'login']);
    });

    // Sudah login
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', function () {
            return view('admin.dashboardAdmin'); // Diarahkan ke dashboard utama admin
        })->name('dashboard');
        
        // Manajemen Kategori (Sebaiknya di dalam middleware auth:admin)
        Route::resource('kategori', KategoriController::class);
    });
});

// Load auth routes hanya satu kali saja
require __DIR__.'/auth.php';