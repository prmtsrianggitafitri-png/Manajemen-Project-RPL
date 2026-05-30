@extends('layouts.layoutMahasiswa')

@section('title', 'SIPRESMA - Daftar Mahasiswa')

@push('styles')
<style>
  .stats-bar {
    background: white; border-radius: 16px;
    padding: 30px 40px; box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    margin-bottom: 40px;
  }
  .stats-bar .stat-item { text-align: center; padding: 0 20px; }
  .stats-bar .stat-item + .stat-item { border-left: 1px solid #eee; }
  .stats-bar .stat-number { font-size: 36px; font-weight: 800; line-height: 1.1; margin-bottom: 4px; }
  .stats-bar .stat-label { font-size: 13px; color: #888; font-weight: 500; }

  .top3-section { margin-bottom: 40px; }
  .top3-section h5 { font-weight: 700; font-size: 16px; color: #2d465e; margin-bottom: 20px; }
  .top3-section h5 i { margin-right: 6px; color: #f39c12; }

  .podium-card {
    background: white; border-radius: 16px; padding: 24px 20px;
    text-align: center; box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    position: relative; transition: 0.2s; cursor: pointer; text-decoration: none; display: block; color: inherit;
  }
  .podium-card:hover { transform: translateY(-4px); box-shadow: 0 6px 20px rgba(0,0,0,0.12); color: inherit; }
  .podium-rank {
    position: absolute; top: -12px; left: 50%; transform: translateX(-50%);
    width: 28px; height: 28px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800; color: white;
  }
  .rank-1 { background: #f39c12; }
  .rank-2 { background: #95a5a6; }
  .rank-3 { background: #cd7f32; }
  .podium-avatar {
    width: 72px; height: 72px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 24px; color: white; margin: 0 auto 12px;
  }
  .podium-name { font-weight: 700; font-size: 15px; color: #2d465e; margin-bottom: 2px; }
  .podium-nim { font-size: 12px; color: #aaa; margin-bottom: 10px; }
  .podium-stats { display: flex; justify-content: center; gap: 20px; }
  .podium-stats .ps-item { text-align: center; }
  .podium-stats .ps-num { font-size: 18px; font-weight: 800; }
  .podium-stats .ps-label { font-size: 11px; color: #aaa; }

  .section-label { font-weight: 700; font-size: 18px; color: #2d465e; margin-bottom: 20px; }
  .avatar-circle {
    width: 56px; height: 56px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 18px; color: white; flex-shrink: 0;
  }
  .mhs-card {
    background: white; border-radius: 12px; padding: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    display: flex; align-items: center; gap: 14px;
    transition: 0.2s; cursor: pointer; text-decoration: none; color: inherit; display: flex;
  }
  .mhs-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.12); color: inherit; }
  .badge-poin {
    background: linear-gradient(135deg, #6f42c1, #d63384);
    color: white; border-radius: 20px; padding: 3px 12px; font-size: 13px; font-weight: 600;
  }
  .rank-text { color: #aaa; font-size: 13px; }
</style>
@endpush

@section('content')
<div class="container">

  @php
    $totalMahasiswa = $mahasiswa->count();
    $totalPoin = $mahasiswa->sum(fn($m) => $m->total_poin ?? 0);
  @endphp
  <div class="stats-bar d-flex justify-content-around flex-wrap gap-3" data-aos="fade-up">
    <div class="stat-item">
      <div class="stat-number" style="color:#e74c3c;">{{ $totalMahasiswa }}</div>
      <div class="stat-label">Mahasiswa</div>
    </div>
    <div class="stat-item">
      <div class="stat-number" style="color:#3498db;">{{ \App\Models\Prestasi::where('status','disetujui')->count() }}</div>
      <div class="stat-label">Total Prestasi</div>
    </div>
    <div class="stat-item">
      <div class="stat-number" style="color:#2ecc71;">{{ number_format($totalPoin, 2) }}</div>
      <div class="stat-label">Total Poin</div>
    </div>
  </div>

  @if($mahasiswa->count() >= 1)
  <div class="top3-section" data-aos="fade-up" data-aos-delay="100">
    <h5><i class="bi bi-trophy-fill"></i> Top Mahasiswa Berprestasi</h5>
    <div class="row g-4 justify-content-center">
      @php $colors = ['#f39c12','#9b59b6','#2ecc71','#e74c3c','#3498db','#e67e22','#1abc9c','#e91e63']; @endphp
      @foreach($mahasiswa->take(3) as $mhs)
        @php
          $words = explode(' ', trim($mhs->nama));
          $inisial = strtoupper(substr($words[0],0,1).(isset($words[1])?substr($words[1],0,1):''));
          $color = $colors[($mhs->ranking-1) % count($colors)];
          $rankClass = 'rank-'.$mhs->ranking;
        @endphp
        <div class="col-lg-3 col-md-4 col-sm-6">
          <a href="{{ route('mahasiswa.profil', $mhs->nim) }}" class="podium-card">
            <div class="podium-rank {{ $rankClass }}">{{ $mhs->ranking }}</div>
            <div class="podium-avatar" style="background:{{ $color }}">{{ $inisial }}</div>
            <div class="podium-name">{{ $mhs->nama }}</div>
            <div class="podium-nim">{{ $mhs->nim }}</div>
            <div class="podium-stats">
              <div class="ps-item">
                <div class="ps-num" style="color:#e74c3c;">{{ $mhs->prestasis_count ?? 0 }}</div>
                <div class="ps-label">Prestasi</div>
              </div>
              <div class="ps-item">
                <div class="ps-num" style="color:#3498db;">{{ number_format($mhs->total_poin ?? 0, 1) }}</div>
                <div class="ps-label">Poin</div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
  @endif

  <div class="section-label" data-aos="fade-up">Semua Mahasiswa</div>
  <div class="row g-3" data-aos="fade-up" data-aos-delay="50">
    @php $colors = ['#f39c12','#9b59b6','#2ecc71','#e74c3c','#3498db','#e67e22','#1abc9c','#e91e63']; @endphp
    @forelse($mahasiswa as $mhs)
      @php
        $words = explode(' ', trim($mhs->nama));
        $inisial = strtoupper(substr($words[0],0,1).(isset($words[1])?substr($words[1],0,1):''));
        $color = $colors[($mhs->ranking-1) % count($colors)];
      @endphp
      <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{ route('mahasiswa.profil', $mhs->nim) }}" class="mhs-card">
          <div class="avatar-circle" style="background:{{ $color }}">{{ $inisial }}</div>
          <div>
            <div class="fw-semibold" style="font-size:15px;">{{ $mhs->nama }}</div>
            <div class="text-muted" style="font-size:13px;">{{ $mhs->nim }}</div>
            <div class="mt-1 rank-text">#{{ $mhs->ranking }}</div>
            <span class="badge-poin mt-1 d-inline-block">★ {{ number_format($mhs->total_poin ?? 0, 1) }} Poin</span>
          </div>
        </a>
      </div>
    @empty
      <div class="col-12 text-center text-muted">Belum ada mahasiswa terdaftar.</div>
    @endforelse
  </div>

</div>
@endsection
