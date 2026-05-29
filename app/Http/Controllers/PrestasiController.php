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

        // ==========================================
        // QUERY 1: UNTUK HALL OF FAME (Disesuaikan ke id_prestasi)
        // ==========================================
        $mahasiswaTerbaik = Prestasi::with(['user.prestasis' => function($q) {
                                $q->where('status', 'disetujui');
                            }])
                            ->where('status', 'disetujui')
                            ->whereIn('id_prestasi', function($q) { // <-- DIUBAH DI SINI
                                $q->select(\DB::raw('MAX(id_prestasi)')) // <-- DIUBAH DI SINI
                                  ->from('prestasis')
                                  ->where('status', 'disetujui')
                                  ->groupBy('nim');
                            })
                            ->latest()
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
            $queryInspirasi->where(function($q) use ($keyword) {
                $q->where('judul', 'LIKE', "%$keyword%")
                  ->orWhere('deskripsi', 'LIKE', "%$keyword%")
                  ->orWhere('bidang', 'LIKE', "%$keyword%")
                  ->orWhere('peringkat', 'LIKE', "%$keyword%");

                // Pencarian berdasarkan nama mahasiswa (lewat relasi 'user')
                $q->orWhereHas('user', function($queryUser) use ($keyword) {
                    $queryUser->where('nama', 'LIKE', "%$keyword%");
                });
            });
        }

        // 4. Eksekusi data hasil saringan untuk Wall of Inspiration
        $prestasis = $queryInspirasi->get();

        // Kirim kedua variabel ke View
        return view('mahasiswa.index', compact('mahasiswaTerbaik', 'prestasis'));
    }

    public function tabelPrestasi()
    {
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

        return view('profile.edit', [
            'user'      => $request->user(),
            'prestasis' => $prestasis,
            'stats'     => $stats,
            'status'    => session('status'),
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
        $prestasi->status      = 'menunggu';

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
        $keyword = $request->input('search');

        $stats = [
            'total_mahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
            'total_prestasi'  => \App\Models\Prestasi::count(),
            'menunggu'        => \App\Models\Prestasi::where('status', 'menunggu')->count(),
            'total_poin'      => \App\Models\Prestasi::where('status', 'disetujui')->sum('jumlah_poin'),
        ];

        $query = \App\Models\Prestasi::with('user')->orderBy('created_at', 'desc');

        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('judul', 'LIKE', "%$keyword%")
                  ->orWhere('bidang', 'LIKE', "%$keyword%")
                  ->orWhere('peringkat', 'LIKE', "%$keyword%")
                  ->orWhere('jumlah_poin', 'LIKE', "%$keyword%")
                  ->orWhere('status', 'LIKE', "%$keyword%");

                // Mencari berdasarkan nama mahasiswa via relasi 'user'
                $q->orWhereHas('user', function($queryUser) use ($keyword) {
                    $queryUser->where('nama', 'LIKE', "%$keyword%");
                });
            });

        }

        $prestasis = $query->get();

        return view('admin.dashboardAdmin', compact('stats', 'prestasis'));
    } // ✅ Kurung tutup dashboardAdmin yang tadinya hilang

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
        ->where(function($query) use ($matchCondition) {
            $query->where($matchCondition);
        })
        ->first();

    if ($like) {
        $like->delete();
        $isLiked = false;
    } else {
        \App\Models\Like::create([
            'id_prestasi' => $id,
            'nim'         => Auth::check() ? Auth::id() : null,
            'ip_address'  => Auth::check() ? null : request()->ip(),
        ]);
        $isLiked = true;
    }

    $likeCount = \App\Models\Like::where('id_prestasi', $id)->count();

    return response()->json([
        'success'   => true,
        'isLiked'   => $isLiked,
        'likeCount' => $likeCount
    ]);
}
}