@extends('layouts.layoutMahasiswa')

@section('title', 'SIPRESMA - Daftar Mahasiswa')

@push('styles')
<style>
  .avatar-circle {
    width: 56px; height: 56px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 18px; color: white;
    flex-shrink: 0;
  }
  .mhs-card {
    background: white;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .mhs-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.12); transition: 0.2s; }
  .badge-poin {
    background: linear-gradient(135deg, #6f42c1, #d63384);
    color: white; border-radius: 20px;
    padding: 3px 12px; font-size: 13px; font-weight: 600;
  }
  .rank-text { color: #aaa; font-size: 13px; }
  
</style>
@endpush

@section('content')
<div class="container">
  <div class="row g-3">
    @php
      $colors = ['#f39c12','#9b59b6','#2ecc71','#e74c3c','#3498db','#e67e22','#1abc9c','#e91e63'];
    @endphp
    @forelse($mahasiswa as $mhs)
      @php
        $words = explode(' ', trim($mhs->nama));
        $inisial = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
        $color = $colors[($mhs->ranking - 1) % count($colors)];
      @endphp
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="mhs-card">
          <div class="avatar-circle" style="background: {{ $color }}">{{ $inisial }}</div>
          <div>
            <div class="fw-semibold" style="font-size:15px;">{{ $mhs->nama }}</div>
            <div class="text-muted" style="font-size:13px;">{{ $mhs->nim }}</div>
            <div class="mt-1 rank-text">#{{ $mhs->ranking }}</div>
            <span class="badge-poin mt-1 d-inline-block">
              ★ {{ number_format($mhs->total_poin ?? 0, 1) }} Poin
            </span>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center text-muted">Belum ada mahasiswa terdaftar.</div>
    @endforelse
  </div>
</div>
@endsection