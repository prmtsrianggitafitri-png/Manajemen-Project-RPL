<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('prestasi.upload', compact('kategoris'));
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
            'jumlah_poin'          => $kategori->jumlah_poin,      
            'bukti_prestasi'      => $buktiPath,
            'dokumentasi_pribadi' => $dokPath,
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil diunggah!');
    }
}