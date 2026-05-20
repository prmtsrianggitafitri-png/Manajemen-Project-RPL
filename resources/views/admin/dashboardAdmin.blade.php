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

            <script>
              function konfirmasiApprove(id) {
                Swal.fire({
                  title: 'Apakah Anda yakin?',
                  text: "Prestasi ini akan langsung disetujui dan tampil di beranda mahasiswa!",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#2dce89', /* Warna hijau sukses Argon */
                  cancelButtonColor: '#f5365c',  /* Warna merah danger Argon */
                  confirmButtonText: 'Ya, Setujui!',
                  cancelButtonText: 'Batal'
                }).then((result) => {
                  if (result.isConfirmed) {
                    // Submit form HTML sesuai dengan ID prestasi yang diklik
                    document.getElementById('form-approve-' + id).submit();
                  }
                })
              }
            </script>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection