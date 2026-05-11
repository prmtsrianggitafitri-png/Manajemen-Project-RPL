<?php

use App\Http\Controllers\Mahasiswa\LayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrestasiController;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Route;
>>>>>>> main

// akses tanpa login
Route::get('/', function () {
    return view('mahasiswa.index');
})->name('home');

Route::get('/sipresma', [LayoutController::class, 'index']);

// autentikasi
require __DIR__.'/auth.php';

// wajib login
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    // manajemen profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Punya mahasiswa
    Route::middleware('role:mahasiswa')->group(function () {
        // Fitur Prestasi
        Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
        Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
        Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    });

    // punya admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', function () {
            return view('admin.dashboardAdmin'); 
        })->name('dashboard');

        // CRUD Kategori
        Route::resource('kategori', KategoriController::class);
        
        // Layout
        Route::get('/cek', function () {
            return view('layouts.layoutAdmin');
        });
    });
<<<<<<< HEAD
});

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
    

Route::middleware('auth')->group(function () {
    Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
    Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::get('/tabelPrestasi', [PrestasiController::class, 'tabelPrestasi']);
    Route::get('/prestasi/edit/{id}', [PrestasiController::class, 'edit'])->name('prestasi.edit');
    Route::put('/prestasi/update/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/delete/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
});
=======
});
>>>>>>> main
