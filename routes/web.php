<?php

use App\Http\Controllers\Mahasiswa\LayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Mahasiswa Routes
|--------------------------------------------------------------------------
*/

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
    Route::get('/profile', [PrestasiController::class, 'edit'])->name('profile.edit');
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
    Route::middleware('role:admin')->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', function () {
            return view('admin.dashboardAdmin'); 
        })->name('admin.dashboard');

        // CRUD Kategori
        Route::get('/manajemenDataKategori', [KategoriController::class, 'index']);
        Route::resource('kategori', KategoriController::class);

        // data mahasiswa
        Route::get('/dataMahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::resource('mahasiswa', MahasiswaController::class)->names([
            'edit' => 'admin.mahasiswa.edit',
            'update' => 'admin.mahasiswa.update',
            'destroy' => 'admin.mahasiswa.destroy',
        ]);
    }); 

    // layout admin belum di middleware
    Route::get('/cek', function () {
        return view('layouts.layoutAdmin');
    });

    // dashboard admin blm di middleware
    Route::get('/admin', function () {
        return view('admin.dashboardAdmin');
    });

    // Route Prestasi Tambahan
    Route::middleware('auth')->group(function () {
        Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
        Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
        Route::get('/tabelPrestasi', [PrestasiController::class, 'tabelPrestasi']);
        Route::get('/prestasi/edit/{id}', [PrestasiController::class, 'edit'])->name('prestasi.edit');
        Route::put('/prestasi/update/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
        Route::delete('/prestasi/delete/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    });

});