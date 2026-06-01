<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    // Menambahkan fitur pencarian publik
    // Menambahkan fitur pencarian publik
    public function home(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari navbar (?search=...)
        $keyword = $request->query('search');

        $totalPrestasi = Prestasi::where('status', 'disetujui')->count();
        $totalMahasiswaAktif = \App\Models\User::where('role', 'mahasiswa')
            ->where('status_mahasiswa', 'aktif')
            ->count();

        // ==========================================
        // QUERY 1: UNTUK HALL OF FAME (Disesuaikan ke id_prestasi)
        // ==========================================
        $mahasiswaTerbaik = \App\Models\User::where('role', 'mahasiswa')
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
            ->having('total_poin', '>', 0)
            ->orderByDesc('total_poin')
            ->take(6)
            ->get();

        // ==========================================
        // QUERY 2: UNTUK WALL OF INSPIRATION (Semua Postingan Prestasi)
        // ==========================================
        $queryInspirasi = Prestasi::where('status', 'disetujui')
            ->with(['mahasiswa', 'user', 'likes'])
            ->latest();

        // 3. Jika ada kata kunci pencarian, saring data Wall of Inspiration
        if ($keyword) {
            $queryInspirasi->where(function ($q) use ($keyword) {
                $q->where('judul', 'LIKE', "%$keyword%")
                    ->orWhere('deskripsi', 'LIKE', "%$keyword%")
                    ->orWhere('bidang', 'LIKE', "%$keyword%")
                    ->orWhere('peringkat', 'LIKE', "%$keyword%");

                // Pencarian berdasarkan nama mahasiswa (lewat relasi 'user')
                $q->orWhereHas('user', function ($queryUser) use ($keyword) {
                    $queryUser->where('nama', 'LIKE', "%$keyword%");
                });
            });
        }

        // 4. Eksekusi data hasil saringan untuk Wall of Inspiration
        $prestasis = $queryInspirasi->paginate(9);

        // Kirim kedua variabel ke View
        return view('mahasiswa.index', compact('mahasiswaTerbaik', 'prestasis', 'totalPrestasi', 'totalMahasiswaAktif'));
    }

    public function tabelPrestasi()
    {
        $kategoris = Kategori::all();
        $prestasis = Prestasi::all();
        return view('prestasi.tabelPrestasi', compact('kategoris', 'prestasis'));
    }

    public function index()
    {
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->orderBy('peringkat', 'asc')->get();
        $prestasis = Prestasi::where('nim', Auth::user()->nim)->get();
        return view('prestasi.upload', compact('kategoris', 'prestasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'bidang' => 'required|in:akademik,non-akademik',
            'bukti_prestasi' => 'required|file|max:512000',
            'dokumentasi_pribadi' => 'nullable|file|max:512000',
        ]);

        $kategori = Kategori::findOrFail($request->id_kategori);
        $buktiPath = $request->file('bukti_prestasi')->store('prestasi/bukti', 'public');

        $dokPath = null;
        if ($request->hasFile('dokumentasi_pribadi')) {
            $dokPath = $request->file('dokumentasi_pribadi')->store('prestasi/dokumentasi', 'public');
        }

        Prestasi::create([
            'id_kategori' => $kategori->id_kategori,
            'nim' => Auth::user()->nim,
            'judul' => $request->judul,
            'bidang' => $request->bidang,
            'deskripsi' => $request->deskripsi,
            'status' => 'menunggu',
            'peringkat' => $kategori->peringkat,
            'jumlah_poin' => $kategori->jumlah_poin,
            'bukti_prestasi' => $buktiPath,
            'dokumentasi_pribadi' => $dokPath,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Prestasi berhasil diunggah!');
    }

    public function edit(Request $request)
    {
        // 1. Tangkap kata kunci pencarian dari navbar global dan hapus spasi ujungnya
        $keyword = trim($request->input('search'));

        // 2. KOTAK STATISTIK: Ambil seluruh data asli tanpa filter keyword agar angkanya tidak berubah
        $semuaPrestasi = \App\Models\Prestasi::where('nim', $request->user()->nim)->get();

        $stats = [
            'diunggah' => $semuaPrestasi->count(),
            'disetujui' => $semuaPrestasi->where('status', 'disetujui')->count(),
            'direvisi' => $semuaPrestasi->where('status', 'revisi')->count(),
            'total_poin' => $semuaPrestasi->where('status', 'disetujui')->sum('jumlah_poin'),
        ];

        // 3. DAFTAR TABEL HISTORI: Siapkan query yang bisa disaring berdasarkan keyword
        $prestasiQuery = \App\Models\Prestasi::where('nim', $request->user()->nim);

        // 4. JIKA USER MELAKUKAN PENCARIAN
        if (!empty($keyword)) {
            // Manipulasi keyword: jika user mengetik "terverifikasi" atau "terverif", arahkan pencarian database ke kata "disetujui"
            $dbKeyword = $keyword;
            if (str_contains(strtolower($keyword), 'verif')) {
                $dbKeyword = 'disetujui';
            }

            $prestasiQuery->where(function ($q) use ($dbKeyword) {
                $q->where('judul', 'LIKE', '%' . $dbKeyword . '%')
                    ->orWhere('bidang', 'LIKE', '%' . $dbKeyword . '%')
                    ->orWhere('peringkat', 'LIKE', '%' . $dbKeyword . '%')
                    ->orWhere('status', 'LIKE', '%' . $dbKeyword . '%');
            });
        }

        // 5. Eksekusi query tabel histori dengan urutan data terbaru
        $prestasis = $prestasiQuery->latest()->get();

        // 6. Kembalikan data dengan struktur array asosiatif yang persis dengan bawaan awal kelompokmu
        return view('profile.edit', [
            'user' => $request->user(),
            'prestasis' => $prestasis, // <-- Berisi data hasil saringan kata kunci pencarian
            'stats' => $stats,     // <-- Angka statistik card warna-warni tetap utuh dan aman
            'status' => session('status'),
        ]);
    }

    public function editPrestasi($id_prestasi)
    {
        $prestasi = Prestasi::findOrFail($id_prestasi);

        if ($prestasi->status == 'disetujui') {
            return redirect()->route('profile.edit')->with('error', 'Data yang sudah disetujui tidak bisa diubah!');
        }

        $kategoris = Kategori::all();
        return view('prestasi.editPrestasi', compact('prestasi', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->status == 'disetujui') {
            return redirect()->route('profile.edit')->with('error', 'Gagal! Data ini sudah permanen (disetujui).');
        }

        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'bidang' => 'required|in:akademik,non-akademik',
            'bukti_prestasi' => 'nullable|file|max:512000',
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

        return redirect()->route('profile.edit')->with('success', 'Prestasi berhasil diperbarui!');
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

    public function dashboardAdmin(Request $request)
    {
        // 1. Tangkap kata kunci pencarian dari navbar admin
        $keyword = trim($request->input('search'));

        // 2. KOTAK STATISTIK ADMIN: Tetap hitung murni dari database agar angkanya tidak rusak saat searching
        $stats = [
            'total_mahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
            'total_prestasi' => \App\Models\Prestasi::count(),
            'menunggu' => \App\Models\Prestasi::where('status', 'menunggu')->count(),
            'total_poin' => \App\Models\Prestasi::where('status', 'disetujui')->sum('jumlah_poin'),
        ];

        // 3. QUERY DASAR TABEL: Ambil data dengan relasi user bawaan asli kelompokmu
        $query = \App\Models\Prestasi::with('user')->orderBy('created_at', 'desc');

        // 4. LOGIKA PENCARIAN CERDAS (Tombol 'Setujui' dan Teks 'Disetujui')
        if ($keyword) {
            $dbKeyword = $keyword;
            $isStatusSearch = false;
            $lowerKeyword = strtolower($keyword);

            // A. Jika admin mencari yang BELUM disetujui (tombol hijau visual)
            if ($lowerKeyword === 'menunggu' || $lowerKeyword === 'setuju' || $lowerKeyword === 'setujui') {
                $dbKeyword = 'menunggu';
                $isStatusSearch = true;
            }
            // B. Jika admin mencari yang SUDAH disetujui (teks abu-abu visual)
            elseif ($lowerKeyword === 'disetujui' || $lowerKeyword === 'sudah disetujui') {
                $dbKeyword = 'disetujui';
                $isStatusSearch = true;
            }
            // C. Jika admin mencari yang direvisi
            elseif ($lowerKeyword === 'revisi') {
                $dbKeyword = 'revisi';
                $isStatusSearch = true;
            }

            // Jalankan filter bersarang ke query builder
            $query->where(function ($q) use ($dbKeyword, $isStatusSearch, $keyword) {
                if ($isStatusSearch) {
                    // Jika mencari kata status, kunci pencarian HANYA di kolom status secara mutlak
                    $q->where('status', $dbKeyword);
                } else {
                    // Jika mencari keyword umum, jalankan LIKE bawaan kelompokmu
                    $q->where('judul', 'LIKE', "%$dbKeyword%")
                        ->orWhere('bidang', 'LIKE', "%$dbKeyword%")
                        ->orWhere('peringkat', 'LIKE', "%$dbKeyword%")
                        ->orWhere('jumlah_poin', 'LIKE', "%$dbKeyword%")
                        ->orWhere('status', 'LIKE', "%$dbKeyword%");

                    // Tetap pertahankan fitur andalan: mencari nama mahasiswa via relasi 'user'
                    $q->orWhereHas('user', function ($queryUser) use ($keyword) {
                        $queryUser->where('nama', 'LIKE', "%$keyword%");
                    });
                }
            });
        }

        // 5. Eksekusi data akhir
        $prestasis = $query->get();

        // 6. Kembalikan variabel 'stats' dan 'prestasis' dengan aman ke view asli admin
        return view('admin.dashboardAdmin', compact('stats', 'prestasis'));
    }

    public function approve($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->status = 'disetujui';
        $prestasi->save();

        return redirect()->back()->with('success', 'Prestasi berhasil disetujui!');
    }

    public function toggleLike($id)
    {
        if (Auth::check()) {
            $matchCondition = ['nim' => Auth::id()];
        } else {
            $matchCondition = ['ip_address' => request()->ip()];
        }

        $like = \App\Models\Like::where('id_prestasi', $id)
            ->where(function ($query) use ($matchCondition) {
                $query->where($matchCondition);
            })
            ->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            \App\Models\Like::create([
                'id_prestasi' => $id,
                'nim' => Auth::check() ? Auth::id() : null,
                'ip_address' => Auth::check() ? null : request()->ip(),
            ]);
            $isLiked = true;
        }

        $likeCount = \App\Models\Like::where('id_prestasi', $id)->count();

        return response()->json([
            'success' => true,
            'isLiked' => $isLiked,
            'likeCount' => $likeCount
        ]);
    }
}