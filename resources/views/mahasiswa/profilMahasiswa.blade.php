@extends('layouts.layoutMahasiswa')

@section('title', 'SIPRESMA - Profil Mahasiswa')

@push('styles')
<style>
  .profil-wrapper { display: flex; gap: 32px; align-items: flex-start; }

  .profil-left {
    width: 260px; flex-shrink: 0;
    background: white; border-radius: 16px;
    padding: 28px 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    text-align: center;
  }
  .profil-avatar {
    width: 100px; height: 100px; border-radius: 20px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 36px; color: white;
    margin: 0 auto 16px;
  }
  .profil-nama { font-weight: 700; font-size: 20px; color: #2d465e; margin-bottom: 4px; }
  .profil-nim { font-size: 13px; color: #aaa; margin-bottom: 4px; }
  .profil-prodi { font-size: 13px; color: #666; font-weight: 500; }

  .profil-right { flex: 1; }

  .profil-stats { display: flex; gap: 20px; margin-bottom: 28px; }
  .stat-card {
    background: white; border-radius: 12px; padding: 20px 24px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07); flex: 1; text-align: center;
  }
  .stat-card .stat-num { font-size: 36px; font-weight: 800; line-height: 1; margin-bottom: 4px; }
  .stat-card .stat-lbl { font-size: 12px; color: #aaa; text-transform: uppercase; letter-spacing: 0.5px; }
  .stat-card .stat-sub { font-size: 11px; font-weight: 600; margin-top: 2px; }

  .histori-header { font-weight: 700; font-size: 16px; color: #2d465e; margin-bottom: 16px; }
  .histori-header i { color: #f39c12; margin-right: 6px; }

  .prestasi-item {
    background: white; border-radius: 12px; padding: 16px 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06); margin-bottom: 12px;
    display: flex; gap: 16px; align-items: flex-start;
  }
  .prestasi-img { width: 64px; height: 64px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
  .prestasi-img-placeholder {
    width: 64px; height: 64px; border-radius: 10px;
    background: #f0f4f8; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
  }
  .prestasi-body { flex: 1; }
  .prestasi-badges { display: flex; gap: 6px; margin-bottom: 6px; flex-wrap: wrap; }
  .badge-bidang { font-size: 11px; font-weight: 600; padding: 2px 10px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; }
  .badge-akademik { background: #e8f4fd; color: #3498db; }
  .badge-nonakademik { background: #fef9e7; color: #f39c12; }
  .prestasi-judul { font-weight: 700; font-size: 15px; color: #2d465e; margin-bottom: 4px; }
  .prestasi-desc { font-size: 13px; color: #666; line-height: 1.5; margin-bottom: 6px; }
  .prestasi-poin {
    display: inline-flex; align-items: center; gap: 4px;
    background: #107ec2; color: white; border-radius: 20px;
    padding: 2px 12px; font-size: 12px; font-weight: 700; float: right;
  }

  .back-link {
    display: inline-flex; align-items: center; gap: 6px;
    color: #107ec2; font-size: 14px; font-weight: 500;
    text-decoration: none; margin-bottom: 24px; transition: 0.2s;
  }
  .back-link:hover { color: #0d6ba8; }

  @media (max-width: 768px) {
    .profil-wrapper { flex-direction: column; }
    .profil-left { width: 100%; }
    .profil-stats { flex-direction: column; }
  }
</style>
@endpush

@section('content')
<div class="container">

  <a href="{{ route('mahasiswa.publik') }}" class="back-link">
    <i class="bi bi-arrow-left"></i> Kembali
  </a>

  @php
    $colors = ['#f39c12','#9b59b6','#2ecc71','#e74c3c','#3498db','#e67e22','#1abc9c','#e91e63'];
    $words = explode(' ', trim($mhs->nama));
    $inisial = strtoupper(substr($words[0],0,1).(isset($words[1])?substr($words[1],0,1):''));
    $color = $colors[abs(crc32($mhs->nim)) % count($colors)];
    $totalPoin = $mhs->prestasis()->where('status','disetujui')->sum('jumlah_poin');
    $totalPrestasi = $mhs->prestasis()->where('status','disetujui')->count();
    $prestasiList = $mhs->prestasis()->with('kategori')->where('status','disetujui')->latest()->get();
  @endphp

  <div class="profil-wrapper">

    {{-- KOLOM KIRI --}}
    <div class="profil-left" data-aos="fade-right">
      <div class="profil-avatar" style="background:{{ $color }}">{{ $inisial }}</div>
      <div class="profil-nama">{{ $mhs->nama }}</div>
      <div class="profil-nim">{{ $mhs->nim }}</div>
      <div class="profil-prodi">Pendidikan Sistem dan Teknologi Informasi</div>
    </div>

    {{-- KOLOM KANAN --}}
    <div class="profil-right" data-aos="fade-left">

      <div class="profil-stats">
        <div class="stat-card">
          <div class="stat-num" style="color:#e74c3c;">{{ number_format($totalPoin, 0) }}</div>
          <div class="stat-lbl">Total Poin</div>
          <div class="stat-sub" style="color:#2ecc71;">Verified</div>
        </div>
        <div class="stat-card">
          <div class="stat-num" style="color:#3498db;">{{ $totalPrestasi }}</div>
          <div class="stat-lbl">Pencapaian</div>
          <div class="stat-sub" style="color:#3498db;">Prestasi</div>
        </div>
      </div>

      <div class="histori-header">
        <i class="bi bi-trophy-fill"></i> Histori Prestasi
      </div>

      @forelse($prestasiList as $p)
      <div class="prestasi-item">
        @if($p->bukti_prestasi)
          <img src="{{ asset('storage/'.$p->bukti_prestasi) }}" alt="{{ $p->judul }}" class="prestasi-img">
        @else
          <div class="prestasi-img-placeholder">
            <i class="bi bi-trophy" style="font-size:24px; color:#ccc;"></i>
          </div>
        @endif
        <div class="prestasi-body">
          <div class="prestasi-badges">
            <span class="badge-bidang {{ $p->bidang == 'akademik' ? 'badge-akademik' : 'badge-nonakademik' }}">
              {{ $p->bidang }}
            </span>
            @if($p->kategori)
              <span class="badge-bidang" style="background:#f0f0f0; color:#666;">{{ $p->kategori->nama_kategori }}</span>
            @endif
          </div>
          <div class="prestasi-judul">{{ $p->judul }}</div>
          <div class="prestasi-desc">{{ $p->deskripsi }}</div>
          <span class="prestasi-poin">+{{ $p->jumlah_poin }} Poin</span>
        </div>
      </div>
      @empty
      <div class="text-center text-muted py-4">Belum ada prestasi yang disetujui.</div>
      @endforelse

    </div>
  </div>

</div>
@endsection
