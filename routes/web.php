<?php

use App\Http\Controllers\Mahasiswa\LayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route; 

// Halaman Utama Publik / Mahasiswa (Sudah memenuhi kriteria ACP Pencarian Beranda)
Route::get('/', function (Illuminate\Http\Request $request) {
    $keyword = $request->input('search');

    // 1. Buat query dasar untuk mengambil prestasi yang SUDAH DISETUJUI (Memenuhi ACP 4)
    $query = \App\Models\Prestasi::with(['mahasiswa', 'kategori', 'likes'])
        ->where('status', 'disetujui')
        ->latest();

    // 2. Logika Pencarian: Cari berdasarkan judul prestasi, bidang, atau peringkat (Memenuhi ACP 1 & 2)
    if ($keyword) {
        $query->where(function($q) use ($keyword) {
            $q->where('judul', 'LIKE', "%$keyword%")
              ->orWhere('bidang', 'LIKE', "%$keyword%")
              ->orWhere('peringkat', 'LIKE', "%$keyword%");
            
            // Opsional: Jika ingin bisa mencari berdasarkan nama mahasiswa yang punya prestasi
            $q->orWhereHas('mahasiswa', function($queryMhs) use ($keyword) {
                $queryMhs->where('nama', 'LIKE', "%$keyword%");
            });
        });
    }

    $prestasis = $query->get();

    return view('mahasiswa.index', compact('prestasis'));
})->name('home');

Route::get('/DaftarMahasiswa', [MahasiswaController::class, 'publik'])->name('mahasiswa.publik');
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
    Route::post('/prestasi/{id}/like', [PrestasiController::class, 'toggleLike'])->name('prestasi.like');

    // ==========================================
    // KHUSUS ROLE: MAHASISWA
    // ==========================================
    Route::middleware('role:mahasiswa')->group(function () {
    Route::get('/prestasi/upload', [PrestasiController::class, 'index'])->name('prestasi.upload');
    Route::post('/prestasi/upload', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::get('/tabelPrestasi', [PrestasiController::class, 'tabelPrestasi']);
    
    // UBAH METHOD YANG DIPANGGIL: dari 'edit' menjadi 'editPrestasi'
    Route::get('/prestasi/edit/{id_prestasi}', [PrestasiController::class, 'editPrestasi'])->name('prestasi.edit');
    
    Route::put('/prestasi/update/{id_prestasi}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/delete/{id_prestasi}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    });

    // ==========================================
    // KHUSUS ROLE: ADMIN
    // ==========================================
    Route::middleware('role:admin')->group(function () {
        Route::post('/admin/prestasi/{id}/approve', [PrestasiController::class, 'approve'])->name('prestasi.approve');
        // Dashboard Admin
        Route::get('/Dashboard', function (Illuminate\Http\Request $request) { 
            $keyword = $request->input('search');

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
            $query = \App\Models\Prestasi::with('user')->orderBy('created_at', 'desc');

            // PENCARIAN ADMIN 
            if ($keyword) {
                $query->where(function($q) use ($keyword) {
                    $q->where('judul', 'LIKE', "%$keyword%")
                      ->orWhere('bidang', 'LIKE', "%$keyword%")
                      ->orWhere('peringkat', 'LIKE', "%$keyword%")
                      ->orWhere('status', 'LIKE', "%$keyword%");

                    $q->orWhereHas('user', function($queryUser) use ($keyword) {
                        $queryUser->where('nama', 'LIKE', "%$keyword%"); 
                    });
                });
            }

            $prestasis = $query->get();

            // 3. Lempar kedua variabel ($stats & $prestasis) ke view
            return view('admin.dashboardAdmin', compact('stats', 'prestasis')); 
        })->name('admin.dashboard');
    }); 

    Route::get('/DataKategori', [KategoriController::class, 'index']);
        Route::resource('kategori', KategoriController::class);

        // Data Mahasiswa
        Route::get('/DataMahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::resource('mahasiswa', MahasiswaController::class)->names([
            'edit' => 'admin.mahasiswa.edit',
            'update' => 'admin.mahasiswa.update',
            'destroy' => 'admin.mahasiswa.destroy',
        ]);

});