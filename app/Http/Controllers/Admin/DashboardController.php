<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_mahasiswa' => User::where('role', 'mahasiswa')->count(),
            'total_prestasi'  => Prestasi::count(),
            'menunggu'        => Prestasi::where('status', 'menunggu')->count(),
            'total_poin'      => Prestasi::where('status', 'disetujui')->sum('jumlah_poin'),
        ];

        // Prestasi menunggu verifikasi
        $prestasis = Prestasi::with('user')
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        // Grafik 6 bulan terakhir
        $statistikBulanan = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $statistikBulanan[] = [
                'bulan'    => $bulan->format('M Y'),
                'total'    => Prestasi::whereYear('created_at', $bulan->year)
                                      ->whereMonth('created_at', $bulan->month)
                                      ->count(),
                'approved' => Prestasi::where('status', 'disetujui')
                                      ->whereYear('created_at', $bulan->year)
                                      ->whereMonth('created_at', $bulan->month)
                                      ->count(),
            ];
        }

        return view('admin.dashboardAdmin', compact('stats', 'prestasis', 'statistikBulanan'));
    }
}