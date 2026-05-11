<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;
=======
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk fungsi hapus file
>>>>>>> main

class PrestasiController extends Controller
{

    public function tabelPrestasi(){
        $kategoris = Kategori::all();
        $prestasis = Prestasi::all();
        
        // Tambahkan 'prestasis' di dalam compact
        return view('prestasi.tabelPrestasi', compact('kategoris', 'prestasis'));
    }
    public function index()
    {
        $kategoris = Kategori::all();
        // Pastikan variabel prestasi juga dikirim ke view agar bisa dilooping untuk dihapus
        $prestasis = Prestasi::where('nim', Auth::user()->nim)->get();
        return view('prestasi.upload', compact('kategoris', 'prestasis'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'id_kategori'         => 'required|exists:kategoris,id_kategori',
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'bidang'              => 'required|in:akademik,non-akademik',
            'bukti_prestasi'      => 'required|file|max:512000', 
            'dokumentasi_pribadi' => 'nullable|file|max:512000',
        ]);

        $kategori = Kategori::findOrFail($request->id_kategori);

        $buktiPath = $request->file('bukti_prestasi')->store('prestasi/bukti', 'public');

        $dokPath = null;
        if ($request->hasFile('dokumentasi_pribadi')) {
            $dokPath = $request->file('dokumentasi_pribadi')->store('prestasi/dokumentasi', 'public');
        }

        Prestasi::create([
            'id_kategori'         => $kategori->id_kategori,
            'nim'                 => Auth::user()->nim, 
            'judul'               => $request->judul,
            'bidang'              => $request->bidang,
            'deskripsi'           => $request->deskripsi,
            'status'              => 'menunggu', 
            'peringkat'           => $kategori->peringkat,
            'jumlah_poin'         => $kategori->jumlah_poin,      
            'bukti_prestasi'      => $buktiPath,
            'dokumentasi_pribadi' => $dokPath,
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil diunggah!');
    }

<<<<<<< HEAD
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        // AC: Jika status disetujui, tidak boleh diedit sama sekali
        if ($prestasi->status == 'disetujui') {
            return redirect('/tabelPrestasi')->with('error', 'Data yang sudah disetujui tidak bisa diubah!');
        }

        $kategoris = Kategori::all();
        return view('prestasi.editPrestasi', compact('prestasi', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->status == 'disetujui') {
            return redirect('/tabelPrestasi')->with('error', 'Gagal! Data ini sudah permanen (disetujui).');
        }

        $request->validate([
            'id_kategori'         => 'required|exists:kategoris,id_kategori',
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'bidang'              => 'required|in:akademik,non-akademik',
            'bukti_prestasi'      => 'nullable|file|max:512000', 
            'dokumentasi_pribadi' => 'nullable|file|max:512000',
        ]);

        $kategori = Kategori::findOrFail($request->id_kategori);

        $prestasi->id_kategori = $request->id_kategori;
        $prestasi->judul = $request->judul;
        $prestasi->bidang = $request->bidang;
        $prestasi->deskripsi = $request->deskripsi;
        $prestasi->peringkat = $kategori->peringkat;
        $prestasi->jumlah_poin = $kategori->jumlah_poin;
        
        $prestasi->status = 'menunggu';

        if ($request->hasFile('bukti_prestasi')) {
            if ($prestasi->bukti_prestasi) {
                Storage::disk('public')->delete($prestasi->bukti_prestasi);
            }
            $prestasi->bukti_prestasi = $request->file('bukti_prestasi')->store('prestasi/bukti', 'public');
        }

        if ($request->hasFile('dokumentasi_pribadi')) {
            if ($prestasi->dokumentasi_pribadi) {
                Storage::disk('public')->delete($prestasi->dokumentasi_pribadi);
            }
            $prestasi->dokumentasi_pribadi = $request->file('dokumentasi_pribadi')->store('prestasi/dokumentasi', 'public');
        }

        $prestasi->save();

        return redirect('/tabelPrestasi')->with('success', 'Prestasi berhasil diperbarui dan sedang menunggu validasi ulang!');
    }


    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->bukti_prestasi) {
            Storage::disk('public')->delete($prestasi->bukti_prestasi);
        }

        if ($prestasi->dokumentasi_pribadi) {
            Storage::disk('public')->delete($prestasi->dokumentasi_pribadi);
        }

        $prestasi->delete();

        return redirect('/tabelPrestasi')->with('success', 'Data prestasi dan filenya berhasil dihapus!');
=======
   public function edit(Request $request)
{
    $prestasis = \App\Models\Prestasi::where('nim', $request->user()->nim)->get();

    $stats = [
        'diunggah'   => $prestasis->count(),
        'disetujui'  => $prestasis->where('status', 'disetujui')->count(),
        'direvisi'   => $prestasis->where('status', 'revisi')->count(),
        'total_poin' => $prestasis->where('status', 'disetujui')->sum('jumlah_poin'),
    ];

    return view('profile.edit', [
        'user' => $request->user(),
        'prestasis' => $prestasis, // Data untuk tabel
        'stats' => $stats,         // Data untuk kotak statistik
        'status' => session('status'),
    ]);
}

    /**
     * Fitur Hapus Prestasi
     */
    public function destroy($id)
    {
        // 1. Cari data prestasi berdasarkan ID
        $prestasi = Prestasi::findOrFail($id);

        // 2. Hapus file bukti_prestasi dari storage jika ada
        if ($prestasi->bukti_prestasi && Storage::disk('public')->exists($prestasi->bukti_prestasi)) {
            Storage::disk('public')->delete($prestasi->bukti_prestasi);
        }

        // 3. Hapus file dokumentasi_pribadi dari storage jika ada
        if ($prestasi->dokumentasi_pribadi && Storage::disk('public')->exists($prestasi->dokumentasi_pribadi)) {
            Storage::disk('public')->delete($prestasi->dokumentasi_pribadi);
        }

        // 4. Hapus data dari database
        $prestasi->delete();

        return redirect()->back()->with('success', 'Data prestasi berhasil dihapus!');
>>>>>>> main
    }
}