@extends('layouts.layoutAdmin')

@section('content')

  {{-- ===== ROW 1: STAT CARDS ===== --}}
  <div class="flex flex-wrap -mx-3">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-600">Mahasiswa</p>
              <h5 class="mb-0 font-bold">{{ $stats['total_mahasiswa'] }} Orang</h5>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                <i class="ni leading-none ni-hat-3 text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal">Jumlah Prestasi</p>
              <h5 class="mb-0 font-bold">{{ $stats['total_prestasi'] }} Data</h5>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- card3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal">Menunggu Validasi</p>
              <h5 class="mb-0 font-bold">{{ $stats['menunggu'] }} Antrean</h5>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                <i class="ni leading-none ni-time-alarm text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- card4 -->
    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Perolehan Poin</p>
              <h5 class="mb-0 font-bold">{{ $stats['total_poin'] }} Poin</h5>
            </div>
            <div class="px-3 text-right basis-1/3">
              <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                <i class="ni leading-none ni-trophy text-lg relative top-3.5 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== ROW 2: GRAFIK STATISTIK ===== --}}
  <div class="flex flex-wrap my-6 -mx-3">
    <div class="w-full px-3">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="border-b border-gray-100 p-6 pb-4 flex items-center justify-between">
          <div>
            <h6 class="font-bold text-slate-700 mb-0">Grafik Statistik Prestasi</h6>
            <p class="text-sm text-slate-400 mb-0">Berdasarkan periode bulan</p>
          </div>
          <div class="flex gap-2">
            <button onclick="filterChart('6')" id="btn-6"
              class="chart-filter-btn px-3 py-1 text-xs font-semibold rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 text-white transition-all">
              6 Bulan
            </button>
            <button onclick="filterChart('3')" id="btn-3"
              class="chart-filter-btn px-3 py-1 text-xs font-semibold rounded-lg bg-gray-100 text-slate-500 hover:bg-gray-200 transition-all">
              3 Bulan
            </button>
          </div>
        </div>
        <div class="flex-auto p-4">
          <canvas id="chart-prestasi" height="100"></canvas>
        </div>
        <div class="flex gap-4 px-6 pb-4">
          <div class="flex items-center gap-1">
            <span class="inline-block w-3 h-3 rounded-full bg-purple-700"></span>
            <span class="text-xs text-slate-500">Total Diajukan</span>
          </div>
          <div class="flex items-center gap-1">
            <span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
            <span class="text-xs text-slate-500">Disetujui</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== ROW 3: TABEL PRESTASI MENUNGGU VERIFIKASI ===== --}}
  <div class="flex flex-wrap my-6 -mx-3">
    <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0">
      <div class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
          <div class="flex items-center justify-between">
            <div>
              <h5 class="mb-0">Prestasi Menunggu Verifikasi</h5>
              <p class="text-sm text-slate-400 mb-0">{{ $stats['menunggu'] }} prestasi perlu ditinjau</p>
            </div>
          </div>
        </div>
        <div class="flex-auto p-3 px-0 pb-2">
          <div class="overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Judul Prestasi</th>
                  <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Nama Mahasiswa</th>
                  <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Bidang</th>
                  <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Peringkat</th>
                  <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Jumlah Poin</th>
                  <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($prestasis as $prestasi)
                  <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                      <span class="text-sm font-semibold leading-tight text-slate-600">{{ $prestasi->judul }}</span>
                    </td>
                    <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                      <span class="text-sm leading-tight text-slate-600">
                        {{ $prestasi->user->nama ?? '-' }}
                      </span>
                    </td>
                    <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                      <span class="text-sm leading-tight text-slate-600">{{ ucfirst($prestasi->bidang) }}</span>
                    </td>
                    <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                      <span class="text-sm leading-tight text-slate-600">{{ $prestasi->peringkat ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                      <span class="text-sm leading-tight text-slate-600">{{ $prestasi->jumlah_poin }}</span>
                    </td>
                    <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                      <form id="form-approve-{{ $prestasi->id_prestasi }}"
                        action="{{ route('prestasi.approve', $prestasi->id_prestasi) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        <button type="button"
                          class="bg-gradient-to-tl from-green-600 to-lime-400 text-white px-3 py-1 rounded text-xs font-bold uppercase cursor-pointer hover:shadow-md"
                          onclick="konfirmasiApprove('{{ $prestasi->id_prestasi }}')">
                          Setujui
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-400">
                      Tidak ada prestasi yang menunggu verifikasi.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const statistikBulanan = @json($statistikBulanan ?? []);
const allLabels   = statistikBulanan.map(d => d.bulan);
const allTotal    = statistikBulanan.map(d => d.total);
const allApproved = statistikBulanan.map(d => d.approved);

const ctx = document.getElementById('chart-prestasi').getContext('2d');
let prestasiChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: allLabels,
    datasets: [
      {
        label: 'Total Diajukan',
        data: allTotal,
        borderColor: '#7e22ce',
        backgroundColor: 'rgba(126,34,206,0.1)',
        borderWidth: 2.5,
        pointBackgroundColor: '#7e22ce',
        pointRadius: 4,
        fill: true,
        tension: 0.4,
      },
      {
        label: 'Disetujui',
        data: allApproved,
        borderColor: '#16a34a',
        backgroundColor: 'rgba(22,163,74,0.1)',
        borderWidth: 2.5,
        pointBackgroundColor: '#16a34a',
        pointRadius: 4,
        fill: true,
        tension: 0.4,
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#1e293b',
        titleColor: '#f8fafc',
        bodyColor: '#cbd5e1',
        padding: 10,
        cornerRadius: 8,
      }
    },
    scales: {
      x: { grid: { display: false }, ticks: { color: '#94a3b8' } },
      y: { beginAtZero: true, ticks: { color: '#94a3b8', stepSize: 1, precision: 0 } }
    }
  }
});

function filterChart(bulan) {
  const n = parseInt(bulan);
  prestasiChart.data.labels = allLabels.slice(-n);
  prestasiChart.data.datasets[0].data = allTotal.slice(-n);
  prestasiChart.data.datasets[1].data = allApproved.slice(-n);
  prestasiChart.update();
  document.querySelectorAll('.chart-filter-btn').forEach(btn => {
    btn.classList.remove('bg-gradient-to-tl','from-purple-700','to-pink-500','text-white');
    btn.classList.add('bg-gray-100','text-slate-500');
  });
  const activeBtn = document.getElementById('btn-' + bulan);
  activeBtn.classList.add('bg-gradient-to-tl','from-purple-700','to-pink-500','text-white');
  activeBtn.classList.remove('bg-gray-100','text-slate-500');
}

function konfirmasiApprove(id) {
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: "Prestasi ini akan langsung disetujui dan tampil di beranda mahasiswa!",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#2dce89',
    cancelButtonColor: '#f5365c',
    confirmButtonText: 'Ya, Setujui!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('form-approve-' + id).submit();
    }
  });
}
</script>
@endpush