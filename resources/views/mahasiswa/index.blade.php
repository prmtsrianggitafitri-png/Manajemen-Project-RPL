@extends('layouts.layoutMahasiswa')

@section('title', 'SIPRESMA')

@push('styles')
<style>
  .modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.5); z-index: 9999;
    align-items: center; justify-content: center;
  }
  .modal-overlay.active { display: flex !important; }
  .modal-box { background: white; padding: 30px; border-radius: 15px; text-align: center; min-width: 300px; }
  .modal-title { font-weight: bold; font-size: 18px; margin-bottom: 10px; }
  .modal-message { color: #666; margin-bottom: 20px; }
  
  .btn-like { border: none; background: none; cursor: pointer; color: #aaa; font-size: 14px; display: flex; align-items: center; gap: 4px; padding: 0; transition: all 0.2s; }
  .btn-like.liked, .btn-like.liked i { color: #e74c3c !important; }
  .btn-like:hover, .btn-like:hover i { color: #e74c3c; }

  /* Modal Detail Prestasi */
  .modal-detail-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.5); z-index: 9999;
    align-items: center; justify-content: center;
    padding: 20px;
  }
  .modal-detail-overlay.active { display: flex !important; }
  .modal-detail-box {
    background: white; border-radius: 15px;
    width: 100%; max-width: 550px;
    max-height: 90vh; overflow-y: auto;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
  }
  .modal-detail-img {
    width: 100%; height: 250px; object-fit: cover;
    border-radius: 15px 15px 0 0;
  }
  .modal-detail-body { padding: 25px; }
  .modal-detail-category {
    font-size: 13px; color: #888;
    text-transform: uppercase; letter-spacing: 1px;
    margin-bottom: 8px;
  }
  .modal-detail-title {
    font-size: 22px; font-weight: 700;
    color: #2d465e; margin-bottom: 15px;
  }
  .modal-detail-desc {
    font-size: 15px; color: #444;
    line-height: 1.7; margin-bottom: 20px;
  }
  .modal-detail-meta {
    display: flex; gap: 15px; flex-wrap: wrap;
    font-size: 13px; color: #666;
    border-top: 1px solid #eee; padding-top: 15px;
    margin-bottom: 20px;
  }
  .modal-detail-meta span { display: flex; align-items: center; gap: 5px; }
  .modal-detail-close {
    width: 100%; padding: 10px;
    background: #107ec2; color: white;
    border: none; border-radius: 8px;
    font-size: 14px; font-weight: 600;
    cursor: pointer; transition: 0.2s;
  }
  .modal-detail-close:hover { background: #0d6ba8; }

  .hall-card {
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  background: white;
}
.hall-card-img {
  width: 100%;
  height: 380px;
  object-fit: cover;
  display: block;
}
.hall-card-info {
  background: white !important;
  padding: 14px 18px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  border-top: 1px solid #f0f0f0 !important;
}
.hall-card-name {
  font-size: 14px !important;
  font-weight: 600 !important;
  color: #2d465e !important;
}
.hall-card-poin {
  font-size: 13px !important;
  color: #f39c12 !important;
  font-weight: 700 !important;
  white-space: nowrap !important;
}
.hall-card-avatar {
  width: 34px !important;
  height: 34px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  color: white !important;
  font-size: 14px !important;
  font-weight: 700 !important;
  flex-shrink: 0 !important;
}

/* Wall of Inspiration - Modern Cards */
.inspo-card {
  border-radius: 20px;
  overflow: hidden;
  background: white;
  box-shadow: 0 4px 24px rgba(16,126,194,0.08);
  transition: all 0.35s cubic-bezier(.4,0,.2,1);
  display: flex;
  flex-direction: column;
  height: 100%;
}
.inspo-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 16px 48px rgba(16,126,194,0.18);
}
.inspo-card .inspo-img-wrap {
  position: relative;
  height: 210px;
  overflow: hidden;
}
.inspo-card .inspo-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.inspo-card:hover .inspo-img-wrap img {
  transform: scale(1.06);
}
.inspo-card .inspo-badge {
  position: absolute;
  top: 14px;
  left: 14px;
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  padding: 5px 13px;
  border-radius: 30px;
  backdrop-filter: blur(6px);
  background: rgba(16,126,194,0.85);
  color: white;
}
.inspo-card .inspo-badge.non-akademik {
  background: rgba(230,126,34,0.85);
}
.inspo-card .inspo-like-wrap {
  position: absolute;
  bottom: 12px;
  right: 14px;
  background: white;
  border-radius: 30px;
  padding: 5px 12px;
  display: flex;
  align-items: center;
  gap: 5px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.12);
}
.inspo-card .inspo-body {
  padding: 20px 22px 16px;
  flex: 1;
  display: flex;
  flex-direction: column;
}
.inspo-card .inspo-title {
  font-size: 18px;
  font-weight: 800;
  color: #1a2e3d;
  margin-bottom: 16px;
  line-height: 1.35;
  flex: 1;
}
.inspo-card .inspo-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 14px;
  border-top: 1.5px solid #f0f4f8;
}
.inspo-card .inspo-author {
  display: flex;
  align-items: center;
  gap: 10px;
}
.inspo-card .inspo-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 14px;
  font-weight: 800;
  flex-shrink: 0;
}
.inspo-card .inspo-author-name {
  font-size: 13px;
  font-weight: 700;
  color: #2d465e;
  display: block;
  line-height: 1.2;
}
.inspo-card .inspo-author-date {
  font-size: 11px;
  color: #b0bec5;
  display: block;
}
.inspo-card .inspo-readmore {
  font-size: 12px;
  font-weight: 700;
  color: #107ec2;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 4px;
  background: #e8f4fd;
  padding: 7px 14px;
  border-radius: 30px;
  transition: all 0.2s;
  white-space: nowrap;
}
.inspo-card .inspo-readmore:hover {
  background: #107ec2;
  color: white;
}
/* Pagination */
.pagination {
  gap: 4px;
}
.pagination .page-link {
  width: 38px;
  height: 38px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  font-weight: 600;
  border: 1px solid #e8edf2;
  color: #2d465e;
  background: white;
  transition: all 0.2s;
}
.pagination .page-link:hover {
  border-color: #107ec2;
  color: #107ec2;
  background: #f0f8ff;
}
.pagination .page-item.active .page-link {
  background: #107ec2;
  border-color: #107ec2;
  color: white;
}
.pagination .page-item.disabled .page-link {
  background: #f8f9fa;
  border-color: #e8edf2;
  color: #ccc;
}
</style>
@endpush

@section('content')

  <section id="call-to-action-2" class="call-to-action-2 section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="d-flex flex-column flex-lg-row gap-4 align-items-center position-relative">
        <div class="content-left flex-grow-1" data-aos="fade-right" data-aos-delay="200">
          <h1>Galeri Prestasi Mahasiswa PSTI</h1>
          <p class="my-4">Dokumentasi digital perjalanan prestasi mahasiswa Program Studi Pendidikan Sistem dan Teknologi Informasi.</p>
          <div class="cta-buttons d-flex flex-wrap gap-3">
            <a href="{{ route('prestasi.upload') }}" class="btn btn-primary">Mulai Berprestasi</a>
          </div>
        </div>
        <div class="content-right position-relative" data-aos="fade-left" data-aos-delay="300">
          <img src="{{ asset('assets/mahasiswa/img/misc/misc-1.webp') }}" alt="Digital Platform" class="img-fluid rounded-4" style="max-height:400px; object-fit:contain;">
          <div class="floating-card">
            <div class="card-icon"><i class="bi bi-people"></i></div>
            <div class="card-content">
              <span class="stats-number">200+</span>
              <span class="stats-text">Mahasiswa Aktif</span>
            </div>
          </div>
          <div class="floating-card-top">
            <div class="card-icon"><i class="bi bi-trophy"></i></div>
            <div class="card-content">
              <span class="stats-number">{{ $prestasis->count() }}+</span>
              <span class="stats-text">Total Prestasi</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<section id="featured-posts" class="featured-posts section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Hall of Fame</h2>
    <div><span>Mahasiswa Terbaik PSTI</span></div>
  </div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    {{-- Ubah pengecekan menjadi $mahasiswaTerbaik --}}
    @if($mahasiswaTerbaik->isEmpty())
      <div class="row">
        <div class="col-12 text-center">
          <p>Belum ada prestasi yang disetujui.</p>
        </div>
      </div>
    @else
      <div class="blog-posts-slider swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {"loop": true,"speed": 800,"autoplay": {"delay": 3000},"slidesPerView": 3,"spaceBetween": 30,"breakpoints": {"320": {"slidesPerView": 1,"spaceBetween": 20},"768": {"slidesPerView": 2,"spaceBetween": 20},"1200": {"slidesPerView": 3,"spaceBetween": 30}}}
        </script>
        <div class="swiper-wrapper">
  @foreach($mahasiswaTerbaik as $mhs)
  <div class="swiper-slide">
    <div class="hall-card">
      @php
        $prestasiTerbaru = $mhs->prestasis->where('status','disetujui')->sortByDesc('created_at')->first();
      @endphp

      @if($prestasiTerbaru && $prestasiTerbaru->dokumentasi_pribadi)
        <img src="{{ asset('storage/' . $prestasiTerbaru->dokumentasi_pribadi) }}"
          alt="{{ $mhs->nama }}" class="hall-card-img">
      @else
        <div style="width:100%; height:380px; background:#eef2f7; display:flex; align-items:center; justify-content:center; flex-direction:column; color:#aaa;">
          <i class="bi bi-image" style="font-size:40px;"></i>
          <p style="font-size:12px; margin-top:8px;">Tidak ada dokumentasi</p>
        </div>
      @endif

     <div class="hall-card-info">
  <div style="display:flex; align-items:center; gap:10px;">
    @php
      $colors = ['#f39c12','#9b59b6','#2ecc71','#e74c3c','#3498db','#e67e22','#1abc9c','#e91e63'];
      $color = $colors[$loop->index % count($colors)];
      $words = explode(' ', trim($mhs->nama ?? 'M'));
      $inisial = strtoupper(substr($words[0],0,1).(isset($words[1])?substr($words[1],0,1):''));
    @endphp
    <div class="hall-card-avatar" style="background:{{ $color }} !important;">
      {{ $inisial }}
    </div>
    <span class="hall-card-name">{{ $mhs->nama }}</span>
  </div>
  <span class="hall-card-poin">🏆 {{ $mhs->total_poin }} Poin</span>
</div>
    </div>
  </div>
  @endforeach
</div>
      </div>
    @endif
  </div>
</section>

 <section id="latest-posts" class="latest-posts section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Wall of Inspiration</h2>
    <div><span>Galeri Prestasi Mahasiswa PSTI</span></div>
  </div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">
      @forelse($prestasis as $p)
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
        <div class="inspo-card">

          {{-- Gambar + badge + like --}}
          <div class="inspo-img-wrap">
            @if($p->bukti_prestasi)
              <img src="{{ asset('storage/' . $p->bukti_prestasi) }}" alt="{{ $p->judul }}">
            @else
              <div style="width:100%;height:100%;background:linear-gradient(135deg,#e8f4fd,#d4edda);display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-image" style="font-size:40px;color:#b0bec5;"></i>
              </div>
            @endif

            {{-- Badge bidang --}}
            <span class="inspo-badge {{ $p->bidang == 'non-akademik' ? 'non-akademik' : '' }}">
              {{ $p->bidang }}
            </span>

            {{-- Like button di atas gambar --}}
            @php 
              if(Auth::check()) {
                  $isLikedByMe = $p->likes->contains('nim', Auth::id());
              } else {
                  $isLikedByMe = $p->likes->contains('ip_address', request()->ip());
              }
              $likeCount = $p->likes->count(); 
            @endphp
            <div class="inspo-like-wrap">
              <button type="button" class="btn-like ajax-like-btn {{ $isLikedByMe ? 'liked' : '' }}" data-id="{{ $p->id_prestasi }}" style="padding:0;">
                <i class="bi {{ $isLikedByMe ? 'bi-heart-fill' : 'bi-heart' }}" id="like-icon-{{ $p->id_prestasi }}"></i>
                <span id="like-count-{{ $p->id_prestasi }}">{{ $likeCount }}</span>
              </button>
            </div>
          </div>

          <div class="inspo-body">
            {{-- Judul --}}
            <h2 class="inspo-title">{{ $p->judul }}</h2>

            {{-- Footer --}}
            <div class="inspo-footer">
              <div class="inspo-author">
              @php
                $colors = ['#f39c12','#9b59b6','#2ecc71','#e74c3c','#3498db','#e67e22','#1abc9c','#e91e63'];
                $color = $colors[$loop->index % count($colors)];
                $words = explode(' ', trim($p->user->nama ?? 'M'));
                $inisial = strtoupper(substr($words[0],0,1).(isset($words[1])?substr($words[1],0,1):''));
              @endphp
              <div class="inspo-avatar" style="background:{{ $color }};">
                {{ $inisial }}
              </div>
              <div>
                <span class="inspo-author-name">{{ $p->user->nama ?? $p->user->name ?? 'Mahasiswa' }}</span>
                <span class="inspo-author-date">{{ $p->created_at->format('M d, Y') }}</span>
              </div>
            </div>

              <a href="#" class="inspo-readmore btn-read-more"
                data-judul="{{ $p->judul }}"
                data-deskripsi="{{ $p->deskripsi }}"
                data-bidang="{{ $p->bidang }}"
                data-nama="{{ $p->user->nama ?? $p->user->name ?? 'Mahasiswa' }}"
                data-poin="{{ $p->jumlah_poin ?? 0 }}"
                data-tanggal="{{ $p->created_at->format('M d, Y') }}"
                data-img="{{ $p->bukti_prestasi ? asset('storage/' . $p->bukti_prestasi) : asset('assets/mahasiswa/img/blog/blog-post-portrait-1.webp') }}">
                Lihat <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
      @empty
      <div class="col-12 text-center"><p>Belum ada prestasi yang disetujui.</p></div>
      @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
      {{ $prestasis->withQueryString()->links() }}
    </div>
  </div>
</section>

  <!-- Modal Detail Prestasi -->
  <div class="modal-detail-overlay" id="modalDetailOverlay">
    <div class="modal-detail-box">
      <img src="" alt="" class="modal-detail-img" id="modalDetailImg">
      <div class="modal-detail-body">
        <p class="modal-detail-category" id="modalDetailCategory"></p>
        <h3 class="modal-detail-title" id="modalDetailTitle"></h3>
        <p class="modal-detail-desc" id="modalDetailDesc"></p>
        <div class="modal-detail-meta">
          <span><i class="bi bi-person"></i> <span id="modalDetailNama"></span></span>
          <span><i class="bi bi-trophy"></i> <span id="modalDetailPoin"></span> Poin</span>
          <span><i class="bi bi-calendar"></i> <span id="modalDetailTanggal"></span></span>
        </div>
        <button class="modal-detail-close" onclick="closeDetailModal()">Tutup</button>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box">
    <div class="modal-icon" id="modalIcon"></div>
    <p class="modal-title" id="modalTitle"></p>
    <p class="modal-message" id="modalMessage"></p>
    <button class="modal-btn" onclick="closeModal()">OK</button>
  </div>
</div>
<script>
  function showModal(icon, title, message) {
    document.getElementById('modalIcon').textContent = icon;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('modalOverlay').classList.add('active');
  }
  function closeModal() {
    document.getElementById('modalOverlay').classList.remove('active');
  }

  // Modal Detail Prestasi
  function closeDetailModal() {
    document.getElementById('modalDetailOverlay').classList.remove('active');
  }

  document.querySelectorAll('.btn-read-more').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('modalDetailImg').src = this.dataset.img;
      document.getElementById('modalDetailImg').alt = this.dataset.judul;
      document.getElementById('modalDetailCategory').textContent = this.dataset.bidang;
      document.getElementById('modalDetailTitle').textContent = this.dataset.judul;
      document.getElementById('modalDetailDesc').textContent = this.dataset.deskripsi;
      document.getElementById('modalDetailNama').textContent = this.dataset.nama;
      document.getElementById('modalDetailPoin').textContent = this.dataset.poin;
      document.getElementById('modalDetailTanggal').textContent = this.dataset.tanggal;
      document.getElementById('modalDetailOverlay').classList.add('active');
    });
  });

  // Tutup modal kalau klik di luar box
  document.getElementById('modalDetailOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeDetailModal();
  });

  // Like button
  document.querySelectorAll('.ajax-like-btn').forEach(button => {
    button.addEventListener('click', function() {
        const prestasiId = this.getAttribute('data-id');
        const icon = document.getElementById(`like-icon-${prestasiId}`);
        const countSpan = document.getElementById(`like-count-${prestasiId}`);
        const currentBtn = this;

        currentBtn.disabled = true;

        fetch(`/prestasi/${prestasiId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                showModal('⚠️', 'Gagal', 'Terjadi kesalahan. Coba refresh halaman.');
                return null;
            }
            return response.json();
        })
        .then(data => {
            if (!data) return;
            if (data.success) {
                countSpan.textContent = data.likeCount;
                if (data.isLiked) {
                    currentBtn.classList.add('liked');
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                } else {
                    currentBtn.classList.remove('liked');
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showModal('❌', 'Koneksi Gagal', 'Gagal memproses tindakan, silakan coba lagi.');
        })
        .finally(() => {
            currentBtn.disabled = false;
        });
    });
  });
</script>
@endpush