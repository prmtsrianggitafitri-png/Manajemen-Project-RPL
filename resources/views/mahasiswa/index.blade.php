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
</head>

<body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top"
    style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px); border-bottom: 1px solid rgba(0, 0, 0, 0.05); transition: all 0.3s ease-in-out; width: 100%; top: 0; left: 0; height: 76px;">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between"
      style="max-width: 1300px; padding: 0 24px;">

      <a class="logo d-flex align-items-center text-decoration-none m-0 p-0">
        <span class="sitename fw-bold"
          style="color: #ff6600; font-size: 1.6rem; font-weight: 800; letter-spacing: 0.5px;">SIPRESMA</span>
      </a>

      <nav id="navmenu" class="navmenu m-0 p-0 d-none d-xl-flex">
        <ul class="d-flex align-items-center gap-4 mb-0 list-unstyled">
          <li><a href="index.html" class="active text-decoration-none"
              style="font-weight: 600; font-size: 0.95rem; transition: 0.3s;">Beranda</a></li>
          <li><a href="about.html" class="text-decoration-none"
              style="font-weight: 500; font-size: 0.95rem; transition: 0.3s;">Direktori</a></li>
          <li><a href="category.html" class="text-decoration-none"
              style="font-weight: 500; font-size: 0.95rem; transition: 0.3s;">Statistik</a></li>
          <li><a href="blog-details.html" class="text-decoration-none"
              style="font-weight: 500; font-size: 0.95rem; transition: 0.3s;">Alumni</a></li>
          <li><a href="faq.html" class="text-decoration-none"
              style="font-weight: 500; font-size: 0.95rem; transition: 0.3s;">FAQ</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-right d-flex align-items-center gap-3 m-0 p-0">

        <div class="search-bar position-relative d-none d-md-block">
          <input type="text" placeholder="Search..." class="form-control ps-3 pe-5 py-2"
            style="border-radius: 20px; border: 1px solid #ced4da; font-size: 0.85rem; width: 160px; height: 38px;">
          <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y pe-3 text-muted"
            style="font-size: 0.85rem;"></i>
        </div>

        <a href="{{ route('login') }}" class="btn px-3 py-2"
          style="color: #212529; background-color: #ffffff; border: 1px solid #ced4da; border-radius: 20px; font-weight: 500; font-size: 0.85rem; height: 38px; line-height: 1.4;">
          Login
        </a>
        <a href="{{ route('register') }}" class="btn px-3 py-2 text-white"
          style="background-color: #ff6600; border: none; border-radius: 20px; font-weight: 500; font-size: 0.85rem; height: 38px; line-height: 1.4;">
          Register
        </a>
      </div>

    </div>
  </header>

  <main class="main">

    <!-- Call To Action 2 Section -->
    <section id="call-to-action-2" class="call-to-action-2 section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="advertise-1 d-flex flex-column flex-lg-row gap-4 align-items-center position-relative">

          <div class="content-left flex-grow-1" data-aos="fade-right" data-aos-delay="200">
            <h1>Galeri Prestasi Mahasiswa PSTI</h1>
            <p class="my-4">Dokumentasi digital perjalanan prestasi mahasiswa Program Studi Pendidikan Sistem dan
              Teknologi Informasi.</p>

            <div class="features d-flex flex-wrap gap-3 mb-4">
              <div class="feature-item">
                <span>Prestasi</span>
              </div>
              <div class="feature-item">
                <span>Mahasiswa</span>
              </div>
              <div class="feature-item">
                <span>Alumni</span>
              </div>
            </div>

            <div class="cta-buttons d-flex flex-wrap gap-3">
              <a href="#" class="btn btn-primary">Mulai Berprestasi</a>
              <a href="#" class="btn btn-outline">Eksplorasi</a>
            </div>
          </div>

          <div class="content-right position-relative" data-aos="fade-left" data-aos-delay="300">
            <img src="{{ asset('assets/mahasiswa/img/misc/misc-1.webp') }}" alt="Digital Platform"
              class="img-fluid rounded-4">
            <div class="floating-card">
              <div class="card-icon">
                <i class="bi bi-graph-up-arrow"></i>
              </div>
              <div class="card-content">
                <span class="stats-number">245%</span>
                <span class="stats-text">Growth Rate</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Call To Action 2 Section -->

    <!-- Hall of Fame Section -->
    <section id="featured-posts" class="featured-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Hall of Fame</h2>
        <div><span>Mahasiswa Terbaik PSTI</span></div>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="blog-posts-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 800,
              "autoplay": {
                "delay": 3000
              },
              "slidesPerView": 3,
              "spaceBetween": 30,
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 20
                },
                "768": {
                  "slidesPerView": 2,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 30
                }
              }
            }
          </script>

          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="blog-post-item">
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-portrait-1.webp') }}" alt="Blog Image">
                <div class="blog-post-content">
                  <div class="post-meta">
                    <span><i class="bi bi-person"></i> Julia Parker</span>
                    <span><i class="bi bi-clock"></i> Jan 15, 2025</span>
                    <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                  </div>
                  <h2><a href="#">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet</a></h2>
                  <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce
                    porttitor metus eget lectus consequat, sit amet feugiat magna vulputate.</p>
                  <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <!-- End slide item -->

            <div class="swiper-slide">
              <div class="blog-post-item">
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-portrait-2.webp') }}" alt="Blog Image">
                <div class="blog-post-content">
                  <div class="post-meta">
                    <span><i class="bi bi-person"></i> Mark Wilson</span>
                    <span><i class="bi bi-clock"></i> Jan 18, 2025</span>
                    <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                  </div>
                  <h2><a href="#">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</a></h2>
                  <p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet adipiscing sem
                    neque sed ipsum.</p>
                  <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div><!-- End slide item -->

            <div class="swiper-slide">
              <div class="blog-post-item">
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-portrait-3.webp') }}" alt="Blog Image">
                <div class="blog-post-content">
                  <div class="post-meta">
                    <span><i class="bi bi-person"></i> Sarah Johnson</span>
                    <span><i class="bi bi-clock"></i> Jan 21, 2025</span>
                    <span><i class="bi bi-chat-dots"></i> 15 Comments</span>
                  </div>
                  <h2><a href="#">At vero eos et accusamus et iusto odio dignissimos ducimus</a></h2>
                  <p>Nullam dictum felis eu pede mollis pretium integer tincidunt cras dapibus vivamus elementum semper
                    nisi.</p>
                  <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div><!-- End slide item -->

            <div class="swiper-slide">
              <div class="blog-post-item">
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-portrait-4.webp') }}" alt="Blog Image">
                <div class="blog-post-content">
                  <div class="post-meta">
                    <span><i class="bi bi-person"></i> David Brown</span>
                    <span><i class="bi bi-clock"></i> Jan 24, 2025</span>
                    <span><i class="bi bi-chat-dots"></i> 10 Comments</span>
                  </div>
                  <h2><a href="#">Et harum quidem rerum facilis est et expedita distinctio</a></h2>
                  <p>Donec quam felis ultricies nec pellentesque eu pretium quis sem nulla consequat massa quis enim.
                  </p>
                  <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div><!-- End slide item -->
          </div>
        </div>
      </div>
    </section>
    <!-- /Hall of Fame Section -->

    <!-- Wall of Inspiration Section -->
    <section id="latest-posts" class="latest-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Wall of Inspiration</h2>
        <div><span>Galeri Prestasi Mahasiswa PSTI</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

          <div class="col-lg-4">
            <article>

              <div class="post-img">
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-1.webp') }}" alt="" class="img-fluid">
              </div>

              <p class="post-category">Politics</p>

              <h2 class="title">
                <a href="blog-details.html">Dolorum optio tempore voluptas dignissimos</a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="{{ asset('assets/mahasiswa/img/person/person-f-12.webp') }}" alt=""
                  class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">Maria Doe</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">Jan 1, 2022</time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-lg-4">
            <article>

              <div class="post-img">
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-2.webp') }}" alt="" class="img-fluid">
              </div>

              <p class="post-category">Sports</p>

              <h2 class="title">
                <a href="blog-details.html">Nisi magni odit consequatur autem nulla dolorem</a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="{{ asset('assets/mahasiswa/img/person/person-f-13.webp') }}" alt=""
                  class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">Allisa Mayer</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">Jun 5, 2022</time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-lg-4">
            <article>

              <div class="post-img">
                <img src="{{ asset('assets/mahasiswa/img/blog/blog-post-3.webp') }}" alt="" class="img-fluid">
              </div>

              <p class="post-category">Entertainment</p>

              <h2 class="title">
                <a href="blog-details.html">Possimus soluta ut id suscipit ea ut in quo quia et soluta</a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="{{ asset('assets/mahasiswa/img/person/person-m-10.webp') }}" alt=""
                  class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">Mark Dower</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">Jun 22, 2022</time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->
        </div>
      </div>

    </section><!-- /Wall of Inspiration Section -->
  </main>

  <footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <span>Mahasiswa PSTI</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a>Kelompok 3 - Rekayasa Perangkat Lunak</a> | <a>Commit & Chill</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/mahasiswa/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/mahasiswa/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/mahasiswa/js/main.js') }}"></script>

</body>

</html>