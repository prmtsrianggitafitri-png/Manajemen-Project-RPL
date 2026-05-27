<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request) // Parameter Request dipertahankan agar fitur pencarian admin aktif
    {
        $keyword = $request->input('search');

        // Filter dasar: Hanya user yang memiliki role 'mahasiswa'
        $query = User::where('role', 'mahasiswa')->orderBy('nama', 'asc');

        // Cari berdasarkan kolom: nama, nim, email, atau status_mahasiswa
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%$keyword%")
                  ->orWhere('nim', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%")
                  ->orWhere('status_mahasiswa', 'LIKE', "%$keyword%");
            });
        }

        $mahasiswa = $query->get();

        return view('admin.dataMahasiswa', compact('mahasiswa'));
    }

   public function publik(Request $request) // 1. Tambahkan parameter Request di sini
    {
        $keyword = $request->input('search');

        // 2. Buat query builder awal
        $query = User::where('role', 'mahasiswa')
            ->withSum(['prestasis as total_poin' => function($q) {
                $q->where('status', 'disetujui');
            }], 'jumlah_poin')
            ->orderByDesc('total_poin');

        // 3. Tambahkan filter jika ada keyword pencarian (bisa cari pakai Nama atau NIM)
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%$keyword%")
                  ->orWhere('nim', 'LIKE', "%$keyword%");
            });
        }

        // 4. Eksekusi query dan hitung ranking secara dinamis
        $mahasiswa = $query->get()->map(function($mhs, $index) {
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

        return redirect('/dataMahasiswa')->with('success', 'Data dan Status Mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mhs = User::where('role', 'mahasiswa')->findOrFail($id);
        $mhs->delete();

        return redirect('/dataMahasiswa')->with('success', 'Data mahasiswa berhasil dihapus dari sistem.');
    }
}