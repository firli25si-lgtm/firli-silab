<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Testimoni Pengguna - SiLab</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('img/silab-icon.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-light px-0 py-2">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <span class="fa fa-phone-alt me-2 text-primary"></span>
                    <span>(021) 789-0123 / Ext. 204</span>
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <span class="far fa-envelope me-2 text-primary"></span>
                    <span>silab@kampus.ac.id</span>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <span class="badge bg-success px-3 py-1"><i class="fa fa-door-open me-1"></i> Laboratorium Buka</span>
            </div>
        </div>
    </div>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="{{ asset('img/silab-logo.png') }}" alt="SiLab Logo" style="height: 50px;" class="me-2">
            <div class="d-none d-sm-block text-start">
                <h2 class="m-0 fw-bold" style="color: #1E40AF; line-height: 1.1;">Si<span style="color: #10B981;">Lab</span></h2>
                <small class="text-muted fw-semi-bold" style="font-size: 11px; letter-spacing: 0.5px;">Inventaris &amp; Peminjaman Lab</small>
            </div>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link">Beranda</a>
                <a href="{{ url('/about') }}" class="nav-item nav-link">Tentang SiLab</a>
                <a href="{{ url('/service') }}" class="nav-item nav-link">Katalog Alat</a>
                <a href="{{ url('/feature') }}" class="nav-item nav-link">Alur Peminjaman</a>
                <a href="{{ url('/contact') }}" class="nav-item nav-link">Kontak &amp; Lokasi</a>
            </div>
            <div class="d-flex align-items-center pe-lg-4 py-2 py-lg-0">
                <a href="{{ url('/#form-pinjam') }}" class="btn btn-primary px-3 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="fa fa-clipboard-check me-1"></i> Ajukan Pinjam
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown fw-bold">Testimoni Pengguna</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Testimoni</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="fs-5 fw-bold text-primary mb-1">ULASAN CIVITAS AKADEMIKA</p>
                <h1 class="display-6 mb-5 fw-bold">Pengalaman Nyata Menggunakan SiLab</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 p-4 border-0 shadow-sm bg-light rounded-3">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p class="text-muted small mb-4">"Sangat memudahkan saat praktikum akhir semester. Tidak perlu rebutan alat karena ketersediaan unit tertera jelas secara real-time di katalog web."</p>
                        <h6 class="fw-bold mb-0">Rangga Pratama</h6>
                        <small class="text-primary">Mahasiswa Teknik Elektro</small>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card h-100 p-4 border-0 shadow-sm bg-light rounded-3">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p class="text-muted small mb-4">"Sebagai asisten lab, pencatatan histori sangat akurat. Mahasiswa yang telat mengembalikan langsung terpantau di rekap data tanpa perlu periksa buku manual."</p>
                        <h6 class="fw-bold mb-0">Nadia Safitri, S.T.</h6>
                        <small class="text-primary">Koordinator Asisten Lab Instrumentasi</small>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card h-100 p-4 border-0 shadow-sm bg-light rounded-3">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p class="text-muted small mb-4">"Fitur cetak tanda terima PDF sangat keren dan rapi! Bukti peminjaman sah langsung kami pegang untuk ditunjukkan ke petugas di loket."</p>
                        <h6 class="fw-bold mb-0">Firli Aditia</h6>
                        <small class="text-primary">Mahasiswa Praktikan PFW</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 py-4 text-center">
        <small>&copy; 2026 SiLab - Sistem Informasi Inventaris &amp; Peminjaman Alat Lab.</small>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
