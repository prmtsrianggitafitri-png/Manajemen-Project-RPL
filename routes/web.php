<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\PrestasiController;
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
});

// Login Mahasiswa (email & password)
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Login Admin (NPSN & password)
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
            return view('layouts.layoutAdmin');
        })->name('dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Prestasi Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
    Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
});