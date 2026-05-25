<?php

use App\Http\Controllers\Mahasiswa\LayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route; 

// Halaman Utama Publik / Mahasiswa (Bisa diakses tanpa login atau sesudah login)
Route::get('/', function (Illuminate\Http\Request $request) { 
    $keyword = $request->input('search');

    // 1. Ambil data prestasi yang statusnya sudah 'disetujui'
    $query = \App\Models\Prestasi::with('user')->where('status', 'disetujui')->orderBy('created_at', 'desc');

    // 2. Jika pengunjung memasukkan kata kunci pencarian
    if ($keyword) {
        $query->where(function($q) use ($keyword) {
            $q->where('judul', 'LIKE', "%$keyword%")
              ->orWhere('bidang', 'LIKE', "%$keyword%")
              ->orWhere('peringkat', 'LIKE', "%$keyword%");

            // Cari berdasarkan nama mahasiswa melalui relasi 'user'
            $q->orWhereHas('user', function($queryUser) use ($keyword) {
                $queryUser->where('nama', 'LIKE', "%$keyword%"); 
            });
        });
    }

    // 3. Eksekusi query
    $prestasis_publik = $query->get();

    // 4. Lempar variabel ke view beranda
    return view('mahasiswa.index', compact('prestasis_publik'));
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
        Route::get('/Dashboard', [PrestasiController::class, 'dashboardAdmin'])->name('admin.dashboard');

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