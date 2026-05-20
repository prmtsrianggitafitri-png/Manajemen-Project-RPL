@extends('mahasiswa.index')

@section('content')
    <div class="container-fluid" style="padding-top: 70px; padding-bottom: 50px; min-height: 100vh;">
        <div class="container">
            <div class="row g-4">

                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4 bg-white">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white"
                                style="background-color: #5b9af8;">
                                <h3 class="fw-bold mb-0">5</h3>
                                <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Diunggah</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white"
                                style="background-color: #47e098;">
                                <h3 class="fw-bold mb-0">0</h3>
                                <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Disetujui</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white"
                                style="background-color: #e29072;">
                                <h3 class="fw-bold mb-0">0</h3>
                                <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Direvisi</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white"
                                style="background-color: #0dcaf0;">
                                <h3 class="fw-bold mb-0">425</h3>
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
                                        <th class="border-0">Nama Prestasi</th>
                                        <th class="border-0">Bidang</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0">Peringkat</th>
                                        <th class="border-0">Poin</th>
                                        <th class="border-0">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestasis as $p)
                                        <tr>
                                            <td class="border-0 text-muted">{{ $p->judul }}</td>
                                            <td class="border-0 text-muted">{{ $p->bidang }}</td>
                                            <td class="border-0 text-muted">{{ $p->status }}</td>
                                            <td class="border-0 text-muted">{{ $p->peringkat }}</td>
                                            <td class="border-0">
                                                <span class="fw-bold text-info">+{{ $p->jumlah_poin }}</span>
                                            </td>
                                            <td
                                                class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <a href="/prestasi/{{ $p->id_prestasi }}/edit"
                                                    onclick="return konfirmasiEdit(event, this.href)"
                                                    class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-pro text-xs ease-soft-in bg-150 tracking-tight-soft bg-x-25 text-slate-400">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>

                                                <form action="/prestasi/{{ $p->id_prestasi }}" method="POST"
                                                    id="form-hapus-{{ $p->id_prestasi }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        onclick="konfirmasiHapus('{{ $p->id_prestasi }}', '{{ $p->judul }}')"
                                                        class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-pro text-xs ease-soft-in bg-150 tracking-tight-soft bg-x-25 text-slate-400">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection