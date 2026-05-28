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
  
  /* FIX CSS: Paksa ikon hati di dalam tombol yang aktif agar otomatis berwarna merah cerah */
  .btn-like { border: none; background: none; cursor: pointer; color: #aaa; font-size: 14px; display: flex; align-items: center; gap: 4px; padding: 0; transition: all 0.2s; }
  .btn-like.liked, .btn-like.liked i { color: #e74c3c !important; }
  .btn-like:hover, .btn-like:hover i { color: #e74c3c; }
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
          <img src="{{ asset('assets/mahasiswa/img/misc/misc-1.webp') }}" alt="Digital Platform" class="img-fluid rounded-4">
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
      <div class="blog-posts-slider swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {"loop": true,"speed": 800,"autoplay": {"delay": 3000},"slidesPerView": 3,"spaceBetween": 30,"breakpoints": {"320": {"slidesPerView": 1,"spaceBetween": 20},"768": {"slidesPerView": 2,"spaceBetween": 20},"1200": {"slidesPerView": 3,"spaceBetween": 30}}}
        </script>
        <div class="swiper-wrapper">
          @forelse($prestasis->take(6) as $p)
          <div class="swiper-slide">
            <div class="blog-post-item">
              @if($p->bukti_prestasi)
                <img src="{{ asset('storage/' . $p->bukti_prestasi) }}" alt="{{ $p->judul }}" style="width:100%; height:220px; object-fit:cover;">
              @else
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-portrait-1.webp') }}" alt="Default">
              @endif
              <div class="blog-post-content">
                <div class="post-meta">
                  <span><i class="bi bi-person"></i> {{ $p->mahasiswa->nama ?? ($p->user->name ?? 'Mahasiswa') }}</span>
                  <span><i class="bi bi-trophy"></i> {{ $p->jumlah_poin ?? 0 }} Poin</span>
                </div>
                <h2><a href="#">{{ $p->judul }}</a></h2>
                <p>{{ Str::limit($p->deskripsi, 100) }}</p>
                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center"><p>Belum ada prestasi yang disetujui.</p></div>
          @endforelse
        </div>
      </div>
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
        <div class="col-lg-4">
          <article>
            <div class="post-img">
              @if($p->bukti_prestasi)
                <img src="{{ asset('storage/' . $p->bukti_prestasi) }}" alt="{{ $p->judul }}" class="img-fluid" style="height:200px; object-fit:cover; width:100%;">
              @else
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-1.webp') }}" alt="" class="img-fluid">
              @endif
            </div>
            <p class="post-category">{{ $p->bidang }}</p>
            <h2 class="title"><a href="#">{{ $p->judul }}</a></h2>

            <div class="d-flex align-items-center justify-content-between">
              <div class="post-meta">
                <p class="post-author mb-0">{{ $p->mahasiswa->nama ?? ($p->user->name ?? 'Mahasiswa') }}</p>
                <p class="post-date mb-0"><time>{{ $p->created_at->format('M d, Y') }}</time></p>
              </div>
              
              @php 
                if(Auth::check()) {
                    $isLikedByMe = $p->likes->contains('user_id', Auth::id());
                } else {
                    $isLikedByMe = $p->likes->contains('ip_address', request()->ip());
                }
                $likeCount = $p->likes->count(); 
              @endphp

              <button type="button" class="btn-like ajax-like-btn {{ $isLikedByMe ? 'liked' : '' }}" data-id="{{ $p->id_prestasi }}">
                <i class="bi {{ $isLikedByMe ? 'bi-heart-fill' : 'bi-heart' }}" id="like-icon-{{ $p->id_prestasi }}"></i> 
                <span id="like-count-{{ $p->id_prestasi }}">{{ $likeCount }}</span>
              </button>
            </div>
          </article>
        </div>
        @empty
        <div class="col-12 text-center"><p>Belum ada prestasi yang disetujui.</p></div>
        @endforelse
      </div>
    </div>
  </section>

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

  // SCRIPT UTAMA FIX: Sinkronisasi perpindahan kelas ikon dan tombol secara linear
  document.querySelectorAll('.ajax-like-btn').forEach(button => {
    button.addEventListener('click', function() {
        const prestasiId = this.getAttribute('data-id');
        const icon = document.getElementById(`like-icon-${prestasiId}`);
        const countSpan = document.getElementById(`like-count-${prestasiId}`);
        const currentBtn = this;

        fetch(`/prestasi/${prestasiId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // 1. Perbarui total angka like
                countSpan.textContent = data.likeCount;

                // 2. Manipulasi visual warna tombol dan ikon hati secara serentak
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
        });
    });
  });
</script>
@endpush