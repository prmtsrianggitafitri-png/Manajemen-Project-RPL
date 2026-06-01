<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // ✅ PERBAIKAN — tambahkan Request dan filter search
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $query = User::where('role', 'mahasiswa')->orderBy('nama', 'asc');

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%$keyword%")
                    ->orWhere('nim', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhere('status_mahasiswa', 'LIKE', "%$keyword%");
            });
        }

        $mahasiswa = $query->get();
        return view('admin.dataMahasiswa', compact('mahasiswa'));
    }

    public function publik(Request $request)
    {
        // 1. Tangkap kata kunci pencarian dari navbar
        $keyword = $request->input('search');

        // 2. Siapkan query dasar untuk mahasiswa aktif
        $query = User::where('role', 'mahasiswa')
            ->where('status_mahasiswa', 'aktif')
            ->withSum([
                'prestasis as total_poin' => function ($q) {
                    $q->where('status', 'disetujui');
                }
            ], 'jumlah_poin')
            ->withCount([
                'prestasis as prestasis_count' => function ($q) {
                    $q->where('status', 'disetujui');
                }
            ])
            ->orderByDesc('total_poin');

        // 3. JIKA ada kata kunci yang dicari, saring berdasarkan Nama atau NIM
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%$keyword%")
                    ->orWhere('nim', 'LIKE', "%$keyword%");
            });
        }

        // 4. Ambil datanya dan buat rangking seperti bawaan awal kelompokmu
        $mahasiswa = $query->get()->map(function ($mhs, $index) {
            $mhs->ranking = $index + 1;
            return $mhs;
        });

        // 5. Kembalikan ke tampilan view tanpa merubah struktur variabel
        return view('mahasiswa.daftarMahasiswa', compact('mahasiswa'));
    }


    public function alumni(Request $request)
    {
        // 1. Tangkap kata kunci pencarian dari navbar adaptif
        $keyword = $request->input('search');

        // 2. Siapkan query dasar untuk mengambil user ber-role mahasiswa yang berstatus alumni
        $query = User::where('role', 'mahasiswa')
            ->where('status_mahasiswa', 'alumni')
            ->withSum([
                'prestasis as total_poin' => function ($q) {
                    $q->where('status', 'disetujui');
                }
            ], 'jumlah_poin')
            ->withCount([
                'prestasis as prestasis_count' => function ($q) {
                    $q->where('status', 'disetujui');
                }
            ])
            ->orderByDesc('total_poin');

        // 3. jika ada input search di navbar alumni, saring berdasarkan Nama atau NIM alumni
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%$keyword%")
                    ->orWhere('nim', 'LIKE', "%$keyword%");
            });
        }

        // 4. Ambil datanya dan petakan nomor rangking bawaan awal aplikasi kalian
        $mahasiswa = $query->get()->map(function ($mhs, $index) {
            $mhs->ranking = $index + 1;
            return $mhs;
        });

        // 5. Kembalikan ke view daftarAlumni tanpa merusak nama variabel aslinya
        return view('mahasiswa.daftarAlumni', compact('mahasiswa'));
    }

    public function profil($id)
    {
        $mhs = User::where('role', 'mahasiswa')->findOrFail($id);
        return view('mahasiswa.profilMahasiswa', compact('mhs'));
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
        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus dari sistem.');
    }
}