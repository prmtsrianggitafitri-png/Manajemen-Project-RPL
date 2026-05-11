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
                        <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white" style="background-color: #5b9af8;">
                            <h3 class="fw-bold mb-0">12</h3>
                            <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Diunggah</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white" style="background-color: #47e098;">
                            <h3 class="fw-bold mb-0">8</h3>
                            <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Disetujui</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white" style="background-color: #e29072;">
                            <h3 class="fw-bold mb-0">2</h3>
                            <small class="text-uppercase" style="font-size: 0.65rem; opacity: 0.9;">Direvisi</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 shadow-sm rounded-4 text-center p-3 text-white" style="background-color: #0dcaf0;">
                            <h3 class="fw-bold mb-0">450</h3>
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
                                    <th class="border-0">Peringkat</th>
                                    <th class="border-0">Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection