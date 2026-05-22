<?php

use App\Http\Controllers\Mahasiswa\LayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $prestasis = \App\Models\Prestasi::with(['mahasiswa', 'kategori', 'likes'])
        ->where('status', 'disetujui')
        ->latest()
        ->get();
    return view('mahasiswa.index', compact('prestasis'));
})->name('home');

Route::get('/sipresma', [LayoutController::class, 'index']);

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    Route::get('/profile', [PrestasiController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
        Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
        Route::get('/tabelPrestasi', [PrestasiController::class, 'tabelPrestasi']);
        Route::get('/prestasi/edit/{id}', [PrestasiController::class, 'edit'])->name('prestasi.edit');
        Route::put('/prestasi/update/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
        Route::delete('/prestasi/delete/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
        Route::post('/prestasi/{id}/like', [PrestasiController::class, 'toggleLike'])->name('prestasi.like');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/Dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/prestasi/{id}/approve', [PrestasiController::class, 'approve'])->name('prestasi.approve');
        Route::get('/DataKategori', [KategoriController::class, 'index']);
        Route::resource('kategori', KategoriController::class);
        Route::get('/DataMahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::resource('mahasiswa', MahasiswaController::class)->names([
            'edit'    => 'admin.mahasiswa.edit',
            'update'  => 'admin.mahasiswa.update',
            'destroy' => 'admin.mahasiswa.destroy',
        ]);
        Route::get('/cek', function () {
            return view('layouts.layoutAdmin');
        });
    });

});