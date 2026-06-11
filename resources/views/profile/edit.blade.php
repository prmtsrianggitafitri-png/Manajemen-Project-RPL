@extends('layouts.layoutMahasiswa')

@section('content')
    <div class="container-fluid" style="padding-top: 10px; padding-bottom: 50px; min-height: 100vh;">
        <div class="container">
            <div class="row g-4">

                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4 bg-white" style="height: fit-content;">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                   <div class="row g-3 mb-4">
                    <div class="col-6 col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white" style="background-color: #5b9af8;">
                            <h3 class="fw-bold mb-0">{{ $stats['diunggah'] }}</h3>
                            <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Diunggah</small>
                        </div>
                    </div>
                    
                    <div class="col-6 col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white" style="background-color: #47e098;">
                            <h3 class="fw-bold mb-0">{{ $stats['disetujui'] }}</h3>
                            <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Disetujui</small>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white" style="background-color: #0dcaf0;">
                            <h3 class="fw-bold mb-0">{{ $stats['total_poin'] }}</h3>
                            <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Total Poin</small>
                        </div>
                    </div>
                </div>

                    <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
                        <h5 class="fw-bold mb-4" style="color: #2d3e50;">Daftar Prestasi</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">Judul Prestasi</th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">Bidang</th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">Peringkat</th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">Poin</th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">Dokumentasi</th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">Status Verifikasi</th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prestasis as $p)
                                        <tr>
                                            <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                                                <span class="text-sm font-semibold leading-tight text-slate-600">{{ $p->judul }}</span>
                                            </td>
                                            <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                                <span class="text-sm leading-tight text-slate-600">{{ ucfirst($p->bidang) }}</span>
                                            </td>
                                            <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                                <span class="text-sm leading-tight text-slate-600">{{ $p->peringkat ?? '-' }}</span>
                                            </td>
                                            <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                                <span class="text-sm leading-tight text-slate-600">{{ $p->jumlah_poin }}</span>
                                            </td>
                                            <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                                <div class="flex justify-center gap-2">
                                                    @if($p->bukti_prestasi)
                                                        <img src="{{ asset('storage/' . $p->bukti_prestasi) }}" class="rounded border border-gray-300 object-contain shadow-sm cursor-pointer" style="max-width: 80px; max-height: 60px; width: auto; height: auto;" title="Klik untuk memperbesar bukti" onclick="window.open(this.src, '_blank')">
                                                    @endif
                                                    @if(!$p->bukti_prestasi && !$p->dokumentasi_pribadi) - @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                                @if($p->status == 'menunggu')
                                                    <span style="color: #b05c00; font-size: 12px; font-weight: bold;">
                                                        <i class="fa-solid fa-clock me-1"></i> Menunggu
                                                    </span>
                                                @elseif($p->status == 'disetujui')
                                                    <span style="color: #27ae60; font-size: 12px; font-weight: bold;">Terverifikasi</span>
                                                @else
                                                    <span class="bg-gradient-to-tl from-red-600 to-pink-500 text-white px-2 py-1 rounded text-xs font-bold uppercase">Revisi</span>
                                                @endif
                                            </td>
                                            <td class="text-center px-3 py-3">
                                                @if(empty($p->status) || $p->status == 'menunggu' || $p->status == 'revisi')
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning border-0 rounded-3 text-xs fw-bold px-2 py-1" onclick="confirmEdit('{{ route('prestasi.edit', $p->id_prestasi) }}', '{{ $p->judul }}')">
                                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-outline-danger border-0 rounded-3 text-xs fw-bold px-2 py-1" onclick="confirmDelete('{{ $p->id_prestasi }}', '{{ $p->judul }}')">
                                                            <i class="fa-solid fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                    <form id="form-delete-{{ $p->id_prestasi }}" action="{{ route('prestasi.destroy', $p->id_prestasi) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @elseif($p->status == 'disetujui')
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <button type="button" class="btn btn-sm btn-outline-danger border-0 rounded-3 text-xs fw-bold px-2 py-1" onclick="confirmDelete('{{ $p->id_prestasi }}', '{{ $p->judul }}')">
                                                            <i class="fa-solid fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                    <form id="form-delete-{{ $p->id_prestasi }}" action="{{ route('prestasi.destroy', $p->id_prestasi) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @else
                                                    <span class="badge bg-light text-muted px-2.5 py-1.5 rounded-3 text-xs fw-medium italic border">
                                                        <i class="fa-solid fa-lock me-1"></i> Locked
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-sm text-slate-400">Kamu belum pernah mengunggah prestasi.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modalEdit" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(2px);">
            <div class="modal-box" style="background: white; padding: 2.5rem; border-radius: 15px; width: 90%; max-width: 400px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                <div class="modal-icon" style="width: 80px; height: 80px; border: 4px solid #f39c12; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: #f39c12; font-size: 40px; font-weight: bold;">?</div>
                <div class="modal-title" style="font-size: 24px; font-weight: 700; color: #444; margin-bottom: 10px;">Konfirmasi Perubahan?</div>
                <div class="modal-text" id="modalEditText" style="font-size: 16px; color: #777; margin-bottom: 25px;">Apakah Anda ingin mengubah data prestasi ini?</div>
                <div class="modal-footer" style="display: flex; gap: 10px; justify-content: center;">
                    <button class="btn-modal" style="padding: 10px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; font-size: 14px; background: #94a3b8; color: white;" onclick="closeEditModal()">Batal</button>
                    <button class="btn-modal" style="padding: 10px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; font-size: 14px; background: #f39c12; color: white;" id="btnConfirmEdit">Ya, Edit!</button>
                </div>
            </div>
        </div>

        <div class="modal-overlay" id="modalDelete" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(2px);">
            <div class="modal-box" style="background: white; padding: 2.5rem; border-radius: 15px; width: 90%; max-width: 400px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                <div class="modal-icon" style="width: 80px; height: 80px; border: 4px solid #f8bb86; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: #f8bb86; font-size: 40px; font-weight: bold;">!</div>
                <div class="modal-title" style="font-size: 24px; font-weight: 700; color: #444; margin-bottom: 10px;">Anda yakin akan menghapusnya?</div>
                <div class="modal-text" id="modalText" style="font-size: 16px; color: #777; margin-bottom: 25px;">Prestasi ini akan hilang dari sistem!</div>
                <div class="modal-footer" style="display: flex; gap: 10px; justify-content: center;">
                    <button class="btn-modal" style="padding: 10px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; font-size: 14px; background: #94a3b8; color: white;" onclick="closeModal()">Batal</button>
                    <button class="btn-modal" style="padding: 10px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; font-size: 14px; background: #d63384; color: white;" id="btnConfirmDelete">Ya, Hapus!</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmEdit(url, judul) {
            document.getElementById('modalEditText').innerText = "Apakah Anda ingin mengubah data prestasi: '" + judul + "'?";
            document.getElementById('btnConfirmEdit').onclick = function () {
                window.location.href = url;
            };
            document.getElementById('modalEdit').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('modalEdit').style.display = 'none';
        }

        function confirmDelete(id, judul) {
            document.getElementById('modalText').innerText = "Prestasi '" + judul + "' akan dihapus permanen dari sistem!";
            document.getElementById('btnConfirmDelete').onclick = function () {
                document.getElementById('form-delete-' + id).submit();
            };
            document.getElementById('modalDelete').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modalDelete').style.display = 'none';
        }
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            background: '#ffffff',
            confirmButtonColor: '#5b9af8', 
            confirmButtonText: 'Oke, Mantap!',
            customClass: { popup: 'rounded-4 shadow-sm' }
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            title: 'Gagal!',
            text: "{{ session('error') }}",
            icon: 'error',
            background: '#ffffff',
            confirmButtonColor: '#e24b4a',
            confirmButtonText: 'Tutup',
            customClass: { popup: 'rounded-4 shadow-sm' }
        });
    </script>
    @endif
@endsection