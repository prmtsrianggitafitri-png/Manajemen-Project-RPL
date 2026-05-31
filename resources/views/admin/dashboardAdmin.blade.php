@extends('layouts.layoutAdmin')

@section('content')
  <!-- row 1 -->
  <div class="flex flex-wrap -mx-3">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
      <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="flex-auto p-4">
          <div class="flex flex-row -mx-3">
            <div class="flex-none w-2/3 max-w-full px-3">
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-600">Mahasiswa</p>
                <h5 class="mb-0 font-bold">
                  {{ $stats['total_mahasiswa'] }} Orang
                </h5>
              </div>
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
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                  Jumlah Prestasi
                </p>
                <h5 class="mb-0 font-bold">
                  {{ $stats['total_prestasi'] }} Data
                </h5>
              </div>
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
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                  Menunggu Validasi
                </p>
                <h5 class="mb-0 font-bold">
                  {{ $stats['menunggu'] }} Antrean
                </h5>
              </div>
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
              <div>
                <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                  Total Perolehan Poin
                </p>
                <h5 class="mb-0 font-bold">
                  {{ $stats['total_poin'] }} Poin
                </h5>
              </div>
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
  <!-- cards row 4 -->
  <div class="flex flex-wrap my-6 -mx-3">
    <!-- card 1 -->
    <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0">
      <div
        class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
          <div class="flex flex-wrap mt-0 -mx-3">
            <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
              <h5>Data Prestasi</h5>
            </div>
          </div>
        </div>
        <div class="flex-auto p-3 px-0 pb-2">
          <div class="overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th
                    class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                    Judul Prestasi
                  </th>
                  <th
                    class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                    Nama Mahasiswa
                  </th>
                  <th
                    class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                    Bidang
                  </th>
                  <th
                    class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                    Peringkat
                  </th>
                  <th
                    class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                    Jumlah Poin
                  </th>
                  <th
                    class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                    Detail
                  </th>
                  <th
                    class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                    Status Verifikasi
                  </th>
                </tr>
              </thead>

              <tbody>
                @forelse($prestasis as $prestasi)
                        <tr>
                          <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                            <span class="text-sm font-semibold leading-tight text-slate-600">{{ $prestasi->judul }}</span>
                          </td>

                          <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                            <span class="text-sm leading-tight text-slate-600">
                              {{ $prestasi->user->nama ?? $prestasi->user->nama_lengkap ?? $prestasi->nim }}
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
                            <button type="button"
                                class="btn-lihat bg-gradient-to-tl from-blue-600 to-cyan-400 text-white px-3 py-1 rounded text-xs font-bold uppercase cursor-pointer hover:shadow-md"
                                data-judul="{{ $prestasi->judul }}"
                                data-bidang="{{ $prestasi->bidang }}"
                                data-peringkat="{{ $prestasi->peringkat ?? '-' }}"
                                data-poin="{{ $prestasi->jumlah_poin }}"
                                data-deskripsi="{{ $prestasi->deskripsi }}"
                                data-nama="{{ $prestasi->user->nama ?? $prestasi->nim }}"
                                data-bukti="{{ $prestasi->bukti_prestasi ? asset('storage/' . $prestasi->bukti_prestasi) : '' }}"
                                data-dok="{{ $prestasi->dokumentasi_pribadi ? asset('storage/' . $prestasi->dokumentasi_pribadi) : '' }}">
                                <i class="fas fa-eye mr-1"></i> Lihat
                            </button>
                        </td>
                          <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                            @if($prestasi->status == 'menunggu')
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
                            @else
                              <span class="text-xxs font-bold tracking-normal uppercase text-slate-400 opacity-70">
                                Disetujui
                              </span>
                            @endif
                          </td>
                        </tr>
                @empty
                  <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-slate-400">Belum ada data prestasi yang
                      di-upload.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Detail Prestasi --}}
<div id="modalDetail" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center; padding:20px;">
    <div style="background:white; border-radius:16px; width:100%; max-width:600px; max-height:90vh; overflow-y:auto; box-shadow:0 10px 40px rgba(0,0,0,0.2);">
        
        {{-- Bukti Prestasi --}}
        <div id="detailImgWrap" style="width:100%; height:250px; background:#f0f4f8; border-radius:16px 16px 0 0; overflow:hidden; display:flex; align-items:center; justify-content:center;">
            <img id="detailImg" src="" alt="" style="width:100%; height:100%; object-fit:cover; display:none;">
            <span id="detailImgEmpty" style="color:#aaa; font-size:13px;">Tidak ada bukti foto</span>
        </div>

        <div style="padding:24px;">
            <p id="detailBidang" style="font-size:12px; color:#888; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;"></p>
            <h4 id="detailJudul" style="font-size:20px; font-weight:700; color:#2d3e50; margin-bottom:12px;"></h4>
            <p id="detailDeskripsi" style="font-size:14px; color:#555; line-height:1.7; margin-bottom:20px;"></p>

            <div style="display:flex; gap:20px; flex-wrap:wrap; font-size:13px; color:#666; border-top:1px solid #eee; padding-top:15px; margin-bottom:16px;">
                <span><i class="fas fa-user mr-1"></i> <span id="detailNama"></span></span>
                <span><i class="fas fa-medal mr-1"></i> <span id="detailPeringkat"></span></span>
                <span><i class="fas fa-star mr-1"></i> <span id="detailPoin"></span> Poin</span>
            </div>

            {{-- Dokumentasi Pribadi --}}
            <div id="detailDokWrap" style="margin-bottom:16px; display:none;">
                <p style="font-size:12px; font-weight:700; color:#888; text-transform:uppercase; margin-bottom:8px;">Dokumentasi Pribadi</p>
                <img id="detailDok" src="" alt="Dokumentasi" style="max-width:100%; border-radius:10px; border:1px solid #eee; cursor:pointer;">
            </div>

            <button onclick="tutupDetail()" style="width:100%; padding:11px; background:#107ec2; color:white; border:none; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer;">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-lihat').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const judul     = this.dataset.judul;
            const bidang    = this.dataset.bidang;
            const peringkat = this.dataset.peringkat;
            const poin      = this.dataset.poin;
            const deskripsi = this.dataset.deskripsi;
            const nama      = this.dataset.nama;
            const buktiUrl  = this.dataset.bukti;
            const dokUrl    = this.dataset.dok;

            document.getElementById('detailJudul').textContent    = judul;
            document.getElementById('detailBidang').textContent   = bidang;
            document.getElementById('detailPeringkat').textContent = peringkat;
            document.getElementById('detailPoin').textContent     = poin;
            document.getElementById('detailDeskripsi').textContent = deskripsi;
            document.getElementById('detailNama').textContent     = nama;

            const img      = document.getElementById('detailImg');
            const imgEmpty = document.getElementById('detailImgEmpty');
            if (buktiUrl) {
                img.src = buktiUrl;
                img.style.display = 'block';
                imgEmpty.style.display = 'none';
            } else {
                img.style.display = 'none';
                imgEmpty.style.display = 'block';
            }

            const dokWrap = document.getElementById('detailDokWrap');
            const dok     = document.getElementById('detailDok');
            if (dokUrl) {
                dok.src = dokUrl;
                dok.onclick = () => window.open(dokUrl, '_blank');
                dokWrap.style.display = 'block';
            } else {
                dokWrap.style.display = 'none';
            }

            document.getElementById('modalDetail').style.display = 'flex';
        });
    });

    function tutupDetail() {
        document.getElementById('modalDetail').style.display = 'none';
    }

    document.getElementById('modalDetail').addEventListener('click', function(e) {
        if (e.target === this) tutupDetail();
    });

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
@endsection