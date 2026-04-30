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
            'id_kategori'         => 'required',
            'judul'               => 'required|string|max:255',
            'deskripsi'           => 'required|string',
            'bidang'              => 'required|in:akademik,non-akademik',
            'bukti_prestasi'      => 'required|file|max:512000',
            'dokumentasi_pribadi' => 'nullable|file|max:512000',
        ]);

        $buktiPath = $request->file('bukti_prestasi')->store('prestasi/bukti', 'public');

        $dokPath = null;
        if ($request->hasFile('dokumentasi_pribadi')) {
            $dokPath = $request->file('dokumentasi_pribadi')->store('prestasi/dokumentasi', 'public');
        }

        Prestasi::create([
            'id_kategori'         => $request->id_kategori,
            'nim'                 => Auth::user()->nim,
            'judul'               => $request->judul,
            'deskripsi'           => $request->deskripsi,
            'bidang'              => $request->bidang,
            'status'              => 'menunggu',
            'poin'                => 0,
            'bukti_prestasi'      => $buktiPath,
            'dokumentasi_pribadi' => $dokPath,
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil diunggah!');
    }
}