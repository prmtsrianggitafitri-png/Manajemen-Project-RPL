<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{

    public function tabelPrestasi(){
        $kategoris = Kategori::all();
        $prestasis = Prestasi::all();
        return view('prestasi.tabelPrestasi', compact('kategoris', 'prestasis'));
    }

    public function index()
    {
        $kategoris = Kategori::all();
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

        // Mengarahkan ke profil setelah sukses upload
        return redirect()->route('profile.edit')->with('success', 'Prestasi berhasil diunggah!');
    }

    public function edit(Request $request)
    {
        $prestasis = \App\Models\Prestasi::where('nim', $request->user()->nim)->get();

        $stats = [
            'diunggah'   => $prestasis->count(),
            'disetujui'  => $prestasis->where('status', 'disetujui')->count(),
            'direvisi'   => $prestasis->where('status', 'revisi')->count(),
            'total_poin' => $prestasis->where('status', 'disetujui')->sum('jumlah_poin'),
        ];
        $stats = [
            'diunggah'   => $prestasis->count(),
            'disetujui'  => $prestasis->where('status', 'disetujui')->count(),
            'direvisi'   => $prestasis->where('status', 'revisi')->count(),
            'total_poin' => $prestasis->where('status', 'disetujui')->sum('jumlah_poin'),
        ];

        return view('profile.edit', [
            'user' => $request->user(),
            'prestasis' => $prestasis, 
            'stats' => $stats,         
            'status' => session('status'),
        ]);
    }

    // AKTIFKAN KEMBALI: Menampilkan halaman form edit per item prestasi mahasiswa
    public function editPrestasi($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        // Proteksi ekstra: Jika status disetujui, tidak boleh diakali via URL langsung
        if ($prestasi->status == 'disetujui') {
            return redirect()->route('profile.edit')->with('error', 'Data yang sudah disetujui tidak bisa diubah!');
        }

        $kategoris = Kategori::all();
        return view('prestasi.editPrestasi', compact('prestasi', 'kategoris'));
    }

    // Memproses update data prestasi mahasiswa
    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->status == 'disetujui') {
            return redirect()->route('profile.edit')->with('error', 'Gagal! Data ini sudah permanen (disetujui).');
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
        $prestasi->judul       = $request->judul;
        $prestasi->bidang      = $request->bidang;
        $prestasi->deskripsi   = $request->deskripsi;
        $prestasi->peringkat   = $kategori->peringkat;
        $prestasi->jumlah_poin = $kategori->jumlah_poin;
        
        // Begitu di-update, status kembali ke 'menunggu' untuk diverifikasi ulang oleh admin
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

        return redirect('/tabelPrestasi')->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->bukti_prestasi && Storage::disk('public')->exists($prestasi->bukti_prestasi)) {
            Storage::disk('public')->delete($prestasi->bukti_prestasi);
        }

        if ($prestasi->dokumentasi_pribadi && Storage::disk('public')->exists($prestasi->dokumentasi_pribadi)) {
            Storage::disk('public')->delete($prestasi->dokumentasi_pribadi);
        }

        $prestasi->delete();

        return redirect()->back()->with('success', 'Data prestasi berhasil dihapus!');
    }

    //fungsi pencarian prestasi yg didashboard
    public function dashboardAdmin(Request $request)
    {
    // 1. Ambil keyword dari form pencarian navbar
    $keyword = $request->input('search');

    // 2. Hitung semua data untuk 4 Card Statistik Admin (Tetap tampil utuh)
    $stats = [
        'total_mahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
        'total_prestasi'  => \App\Models\Prestasi::count(),
        'menunggu'        => \App\Models\Prestasi::where('status', 'menunggu')->count(),
        'total_poin'      => \App\Models\Prestasi::where('status', 'disetujui')->sum('jumlah_poin'),
    ];

    // 3. Buat query dasar untuk tabel prestasi (Eager loading 'user' sesuai code awalmu)
    // Catatan: di file web.php relasimu bernama 'user', maka kita gunakan 'user'
    $query = \App\Models\Prestasi::with('user')->orderBy('created_at', 'desc');

    // 4. Jalankan pencarian multi-kolom jika keyword diisi
    if ($keyword) {
        $query->where(function($q) use ($keyword) {
            $q->where('judul', 'LIKE', "%$keyword%")
              ->orWhere('bidang', 'LIKE', "%$keyword%")
              ->orWhere('peringkat', 'LIKE', "%$keyword%")
              ->orWhere('jumlah_poin', 'LIKE', "%$keyword%")
              ->orWhere('status', 'LIKE', "%$keyword%");

            // Mencari berdasarkan nama mahasiswa via relasi 'user'
            $q->orWhereHas('user', function($queryUser) use ($keyword) {
                $queryUser->where('nama', 'LIKE', "%$keyword%"); // Sesuaikan jika kolom namanya 'name' atau 'nama'
            });
        });
    }

    // 5. Eksekusi query tabel
    $prestasis = $query->get();

    // 6. Lempar ke view dashboard admin
    return view('admin.dashboardAdmin', compact('stats', 'prestasis'));

    public function approve($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status = 'disetujui';
        $prestasi->save();

        return redirect()->back()->with('success', 'Prestasi berhasil disetujui!');
    }

    // ✅ BARU: Toggle Like
    public function toggleLike($id)
    {
        $like = \App\Models\Like::where('user_id', Auth::id())
            ->where('id_prestasi', $id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            \App\Models\Like::create([
                'user_id'     => Auth::id(),
                'id_prestasi' => $id,
            ]);
        }

        return back();
    }
}