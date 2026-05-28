<?php

use App\Http\Controllers\Mahasiswa\LayoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route; 

Route::get('/', function () {
    $prestasis = \App\Models\Prestasi::with(['mahasiswa', 'kategori', 'likes'])
        ->where('status', 'disetujui')
        ->latest()
        ->get();
    return view('mahasiswa.index', compact('prestasis'));
})->name('home');

Route::get('/DaftarMahasiswa', [MahasiswaController::class, 'publik'])->name('mahasiswa.publik');
Route::get('/DaftarAlumni', [MahasiswaController::class, 'alumni'])->name('mahasiswa.alumni');
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'profil'])->name('mahasiswa.profil');
Route::get('/sipresma', [LayoutController::class, 'index']);

Route::post('/prestasi/{id}/like', [PrestasiController::class, 'toggleLike'])->name('prestasi.like');

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
        Route::get('/prestasi/edit/{id_prestasi}', [PrestasiController::class, 'editPrestasi'])->name('prestasi.edit');
        Route::put('/prestasi/update/{id_prestasi}', [PrestasiController::class, 'update'])->name('prestasi.update');
        Route::delete('/prestasi/delete/{id_prestasi}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/Dashboard', function () {
            $stats = [
                'total_mahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
                'total_prestasi'  => \App\Models\Prestasi::count(),
                'menunggu'        => \App\Models\Prestasi::where('status', 'menunggu')->count(),
                'total_poin'      => \App\Models\Prestasi::where('status', 'disetujui')->sum('jumlah_poin'),
            ];
            $prestasis = \App\Models\Prestasi::with('user')->orderBy('created_at', 'desc')->get();
            return view('admin.dashboardAdmin', compact('stats', 'prestasis')); 
        })->name('admin.dashboard');

        Route::post('/admin/prestasi/{id}/approve', [PrestasiController::class, 'approve'])->name('prestasi.approve');
        Route::get('/DataKategori', [KategoriController::class, 'index']);
        Route::resource('kategori', KategoriController::class);
        Route::get('/DataMahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::resource('mahasiswa', MahasiswaController::class)->names([
            'edit' => 'admin.mahasiswa.edit',
            'update' => 'admin.mahasiswa.update',
            'destroy' => 'admin.mahasiswa.destroy',
        ]);
        Route::get('/cek', function () {
            return view('layouts.layoutAdmin');
        });
    }); 

});
