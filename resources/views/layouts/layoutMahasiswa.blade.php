<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'SIPRESMA')</title>

  <link rel="icon" type="image/jpeg" href="{{ asset('assets/mahasiswa/img/logo.jpeg') }}"/>
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

  <link href="{{ asset('assets/mahasiswa/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/mahasiswa/css/main.css') }}" rel="stylesheet">
  
  @stack('styles')
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top custom-header">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between custom-container">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center text-decoration-none m-0 p-0">
        <span class="sitename fw-bold custom-logo">SIPRESMA</span>
      </a>
      <nav id="navmenu" class="navmenu m-0 p-0 d-none d-xl-flex">
        <ul class="d-flex align-items-center gap-4 mb-0 list-unstyled">
          <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active custom-nav-link' : 'custom-nav-link-normal' }}">Beranda</a></li>
          <li><a href="{{ route('mahasiswa.publik') }}" class="{{ Request::is('daftar-mahasiswa') ? 'active custom-nav-link' : 'custom-nav-link-normal' }}">Mahasiswa</a></li>
          <li><a href="#" class="custom-nav-link-normal">Alumni</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <div class="header-right d-flex align-items-center gap-3 m-0 p-0">
        <div class="search-bar position-relative d-none d-md-block">
          <input type="text" placeholder="Search..." class="form-control ps-4 pe-6 py-2 custom-search-input">
          <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y pe-3 text-muted" style="font-size: 0.85rem;"></i>
        </div>
        @auth
          <div class="dropdown">
            <button class="btn dropdown-toggle d-flex align-items-center gap-2 custom-btn-login" type="button"
              id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userMenu">
              <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Info Profile</a></li>
              <li><hr class="dropdown-divider"></li>
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
          <a href="{{ route('login') }}" class="btn px-3 py-2 custom-btn-login">Login</a>
          <a href="{{ route('register') }}" class="btn px-3 py-2 custom-btn-register">Register</a>
        @endauth
      </div>
    </div>
  </header>

  <main class="main" style="margin-top: 110px; padding-bottom: 60px;">
    @yield('content')
  </main>

  <footer id="footer" class="footer">
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <span>Mahasiswa PSTI</span></p>
      <div class="credits">
        Designed by <a>Kelompok 3 - Rekayasa Perangkat Lunak</a> | <a>Commit & Chill</a>
      </div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <script src="{{ asset('assets/mahasiswa/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/js/main.js') }}"></script>

  @stack('scripts')
</body>
</html>