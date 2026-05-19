<?php

use App\Http\Controllers\Mahasiswa\LayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route; 

// Halaman Utama Publik / Mahasiswa (Bisa diakses tanpa login atau sesudah login)
Route::get('/', function () {
    return view('mahasiswa.index');
})->name('home');

Route::get('/sipresma', [LayoutController::class, 'index']);

// Fitur Autentikasi (Login, Register, dll)
require __DIR__.'/auth.php';

// Group Route: Wajib Login & Terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    // Manajemen Profile
    Route::get('/profile', [PrestasiController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // KHUSUS ROLE: MAHASISWA
    // ==========================================
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
        Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
        Route::get('/tabelPrestasi', [PrestasiController::class, 'tabelPrestasi']);
        Route::get('/prestasi/edit/{id}', [PrestasiController::class, 'edit'])->name('prestasi.edit');
        Route::put('/prestasi/update/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
        Route::delete('/prestasi/delete/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    });

    // ==========================================
    // KHUSUS ROLE: ADMIN
    // ==========================================
    Route::middleware('role:admin')->group(function () {
        // Dashboard Admin
        Route::get('/Dashboard', function () {
        // 1. Hitung semua data untuk 4 Card Statistik Admin
        $stats = [
            // Card 1: Total mahasiswa unik yang memiliki role 'mahasiswa' 
            'total_mahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
            
            // Card 2: Total seluruh data prestasi yang masuk (semua status)
            'total_prestasi'  => \App\Models\Prestasi::count(),
            
            // Card 3: Total prestasi yang statusnya masih 'menunggu'
            'menunggu'        => \App\Models\Prestasi::where('status', 'menunggu')->count(),
            
            // Card 4: Total akumulasi poin dari prestasi yang SUDAH DISETUJUI
            'total_poin'      => \App\Models\Prestasi::where('status', 'disetujui')->sum('jumlah_poin'),
        ];

        // 2. Ambil semua data prestasi untuk isi Tabel (eager loading 'user' agar performa enteng)
        $prestasis = \App\Models\Prestasi::with('user')->orderBy('created_at', 'desc')->get();

        // 3. Lempar kedua variabel ($stats & $prestasis) ke view
        return view('admin.dashboardAdmin', compact('stats', 'prestasis')); 
        })->name('admin.dashboard');

        // FITUR UTAMA: Verifikasi & Approval Prestasi oleh Admin
        Route::post('/admin/prestasi/{id}/approve', [PrestasiController::class, 'approve'])->name('prestasi.approve');

        // CRUD Kategori
        Route::get('/DataKategori', [KategoriController::class, 'index']);
        Route::resource('kategori', KategoriController::class);

        // Data Mahasiswa
        Route::get('/DataMahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::resource('mahasiswa', MahasiswaController::class)->names([
            'edit' => 'admin.mahasiswa.edit',
            'update' => 'admin.mahasiswa.update',
            'destroy' => 'admin.mahasiswa.destroy',
        ]);

        // Cek Layout Admin (Opsional untuk testing internal admin)
        Route::get('/cek', function () {
            return view('layouts.layoutAdmin');
        });
    }); 

});