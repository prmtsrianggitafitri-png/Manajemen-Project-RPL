<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->orderBy('nama', 'asc')->get();

        return view('admin.dataMahasiswa', compact('mahasiswa'));
    }

    public function publik()
    {
        $mahasiswa = User::where('role', 'mahasiswa')
            ->withSum(['prestasis as total_poin' => function($q) {
                $q->where('status', 'disetujui');
            }], 'jumlah_poin')
            ->orderByDesc('total_poin')
            ->get()
            ->map(function($mhs, $index) {
                $mhs->ranking = $index + 1;
                return $mhs;
            });

        return view('mahasiswa.daftarMahasiswa', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $mhs = User::where('role', 'mahasiswa')->findOrFail($id);

        return view('admin.editdataMahasiswa', compact('mhs'));
    }

    public function update(Request $request, $id)
    {
        $mhs = User::where('role', 'mahasiswa')->findOrFail($id);

        $request->validate([
            'status_mahasiswa' => 'required|in:aktif,alumni',
            'nama' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        $mhs->update([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'status_mahasiswa' => $request->status_mahasiswa,
        ]);

        return redirect('/DataMahasiswa')->with('success', 'Data dan Status Mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mhs = User::where('role', 'mahasiswa')->findOrFail($id);
        $mhs->delete();

        return redirect('/dataMahasiswa')->with('success', 'Data mahasiswa berhasil dihapus dari sistem.');
    }
}