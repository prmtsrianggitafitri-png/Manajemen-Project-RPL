<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SIPRESMA</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/mahasiswa/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/mahasiswa/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/mahasiswa/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/mahasiswa/css/main.css') }}" rel="stylesheet">
  <style>
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active { 
            display: flex !important; 
        }

        .modal-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            min-width: 300px;
        }
        
        /* Tambahin warna teks biar kelihatan */
        .modal-title { font-weight: bold; font-size: 18px; margin-bottom: 10px; }
        .modal-message { color: #666; margin-bottom: 20px; }
    </style>
</head>

<body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top custom-header">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between custom-container">

      <a class="logo d-flex align-items-center text-decoration-none m-0 p-0">
        <span class="sitename fw-bold custom-logo">SIPRESMA</span>
      </a>

      <nav id="navmenu" class="navmenu m-0 p-0 d-none d-xl-flex">
        <ul class="d-flex align-items-center gap-4 mb-0 list-unstyled">
          <li><a href="{{ url('/') }}" class="active custom-nav-link">Beranda</a></li>
          <li><a href="about.html" class="custom-nav-link-normal">Mahasiswa</a></li>
          <li><a href="category.html" class="custom-nav-link-normal">Alumni</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-right d-flex align-items-center gap-3 m-0 p-0">

        <form action="{{ route('home') }}" method="GET" class="search-bar position-relative d-none d-md-block m-0">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-control ps-4 pe-6 py-2 custom-search-input">
        <button type="submit" class="position-absolute top-50 end-0 translate-middle-y pe-3 border-0 bg-transparent text-muted" style="font-size: 0.85rem; z-index: 5;">
        <i class="bi bi-search"></i>
        </button>
        </form>

        @auth
          <div class="dropdown">
            <button class="btn dropdown-toggle d-flex align-items-center gap-2 custom-btn-login" type="button"
              id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userMenu">
              <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Info
                  Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </div>

        @else
          <a href="{{ route('login') }}" class="btn px-3 py-2 custom-btn-login">
            Login
          </a>
          <a href="{{ route('register') }}" class="btn px-3 py-2 custom-btn-register">
            Register
          </a>
        @endauth

      </div>
    </div>
  </header>

  <main style="margin-top: 70px;"></main>
  @if(Request::is('profile*'))
        @yield('content')
  @else

  <main class="main">

    <!-- Call To Action 2 Section -->
    <section id="call-to-action-2" class="call-to-action-2 section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="d-flex flex-column flex-lg-row gap-4 align-items-center position-relative">

          <div class="content-left flex-grow-1" data-aos="fade-right" data-aos-delay="200">
            <h1>Galeri Prestasi Mahasiswa PSTI</h1>
            <p class="my-4">Dokumentasi digital perjalanan prestasi mahasiswa Program Studi Pendidikan Sistem dan
              Teknologi Informasi.</p>

            <div class="cta-buttons d-flex flex-wrap gap-3">
              <a href="{{ route('prestasi.upload') }}" class="btn btn-primary">Mulai Berprestasi</a>
              <a href="#" class="btn btn-outline">Eksplorasi</a>
            </div>
          </div>

          <div class="content-right position-relative" data-aos="fade-left" data-aos-delay="300">
            <img src="{{ asset('assets/mahasiswa/img/misc/misc-1.webp') }}" alt="Digital Platform"
              class="img-fluid rounded-4">

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
                <span class="stats-number">300+</span>
                <span class="stats-text">Total Prestasi</span>
              </div>
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
          <div class="swiper-slide">
            <div class="blog-post-item">
              <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-portrait-1.webp') }}" alt="Default">
              <div class="blog-post-content"><p>Belum ada prestasi yang disetujui.</p></div>
            </div>
          </div>
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
              @auth
                @php $liked = $p->likes->contains('user_id', Auth::id()); $likeCount = $p->likes->count(); @endphp
                <form action="{{ route('prestasi.like', $p->id_prestasi) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn-like {{ $liked ? 'liked' : '' }}">
                    <i class="bi {{ $liked ? 'bi-heart-fill' : 'bi-heart' }}"></i> {{ $likeCount }}
                  </button>
                </form>
              @else
                <a href="{{ route('login') }}" class="btn-like">
                  <i class="bi bi-heart"></i> {{ $p->likes->count() }}
                </a>
              @endauth
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
  @if(session('success'))
  window.addEventListener('DOMContentLoaded', function() {
    showModal('✅', 'Berhasil!', '{{ session("success") }}');
  });
  @endif
</script>
@endpush