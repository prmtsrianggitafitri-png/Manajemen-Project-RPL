<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kategoriController;

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

//dashboard admin

//Belum di middleware buat admin
 //kategori
 Route::get('/manajemenDataKategori', [KategoriController::class, 'index']);
 Route::resource('kategori', KategoriController::class);

require __DIR__.'/auth.php';

// layout admin belum di midleware
Route::get('/cek', function () {
    return view('layouts.layoutAdmin');
});

// dasboard admin blm di midleware
Route::get('/admin', function () {
    return view('admin.dashboardAdmin');
});

use App\Http\Controllers\PrestasiController;

Route::middleware('auth')->group(function () {
    Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
    Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
});
