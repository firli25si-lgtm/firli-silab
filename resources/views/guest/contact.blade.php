<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kontak & Lokasi - SiLab Laboratorium</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Kontak SiLab, Lokasi Lab Kampus, Jam Operasional" name="keywords">
    <meta content="Kontak dan Lokasi Pelayanan Laboratorium SiLab Kampus" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/silab-icon.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


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
                <div class="h-100 d-inline-flex align-items-center">
                    <span class="far fa-clock me-2 text-primary"></span>
                    <span>Senin - Jumat: 08:00 - 16:30 WIB</span>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center me-3">
                    <span class="badge bg-success px-3 py-1"><i class="fa fa-door-open me-1"></i> Laboratorium Buka</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


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
                <a href="{{ url('/contact') }}" class="nav-item nav-link active">Kontak &amp; Lokasi</a>
            </div>
            <div class="d-flex align-items-center pe-lg-4 py-2 py-lg-0">
                <a href="{{ url('/#form-pinjam') }}" class="btn btn-primary px-3 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="fa fa-clipboard-check me-1"></i> Ajukan Pinjam
                </a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown fw-bold">Kontak &amp; Layanan Lab</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Kontak</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary mb-1">PUSAT BANTUAN LABORATORIUM</p>
                    <h1 class="display-6 mb-4 fw-bold">Hubungi Petugas &amp; Asisten Laboratorium</h1>
                    <p class="text-muted mb-4">Jika Anda memiliki kendala teknis terhadap alat, pertanyaan seputar perpanjangan masa pinjam, atau ketersediaan modul khusus, silakan hubungi tim kami.</p>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-square bg-light rounded-circle me-3">
                            <i class="fa fa-map-marker-alt text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Lokasi Laboratorium:</h6>
                            <span class="text-muted small">Gedung Laboratorium Terpadu, Lantai 2, Kampus Utama</span>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-square bg-light rounded-circle me-3">
                            <i class="fa fa-phone-alt text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Telepon &amp; Helpdesk:</h6>
                            <span class="text-muted small">(021) 789-0123 / Ext. 204 (Senin - Jumat 08.00 - 16.30 WIB)</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-square bg-light rounded-circle me-3">
                            <i class="fa fa-envelope text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Surel Resmi:</h6>
                            <span class="text-muted small">silab@kampus.ac.id / bantuan.lab@kampus.ac.id</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-light rounded-3 p-4 p-sm-5 shadow-sm">
                        <h4 class="fw-bold mb-3">Kirim Pesan / Pertanyaan</h4>
                        <form onsubmit="event.preventDefault(); alert('Pesan Anda telah terkirim ke petugas lab SiLab. Terima kasih!'); this.reset();">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Anda</label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">NIM / NIP</label>
                                    <input type="text" class="form-control" placeholder="Nomor Induk" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Subjek Pesan</label>
                                    <input type="text" class="form-control" placeholder="Contoh: Konsultasi ketersediaan Logic Analyzer" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Isi Pesan</label>
                                    <textarea class="form-control" rows="4" placeholder="Tuliskan pertanyaan atau kebutuhan Anda..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary py-3 px-4 rounded-pill fw-bold w-100" type="submit">
                                        <i class="fa fa-paper-plane me-2"></i>Kirim Pesan ke Petugas Lab
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('img/silab-logo.png') }}" alt="SiLab" style="height: 48px; background: white; border-radius: 6px; padding: 4px;" class="mb-3">
                    <h5 class="text-white mb-3">SiLab Kampus</h5>
                    <p class="text-muted small">Sistem Informasi Inventaris &amp; Peminjaman Alat Laboratorium terintegrasi untuk mendukung kegiatan praktikum dan riset teknologi.</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-4">Lokasi &amp; Jam Layanan</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3 text-primary"></i>Gedung Laboratorium Terpadu, Lantai 2</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3 text-primary"></i>(021) 789-0123 / Ext. 204</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3 text-primary"></i>silab@kampus.ac.id</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-4">Tautan Cepat</h5>
                    <a class="btn btn-link" href="{{ url('/') }}">Beranda</a>
                    <a class="btn btn-link" href="{{ url('/about') }}">Tentang SiLab</a>
                    <a class="btn btn-link" href="{{ url('/service') }}">Katalog Alat</a>
                    <a class="btn btn-link" href="{{ url('/feature') }}">Alur Peminjaman</a>
                    <a class="btn btn-link" href="{{ url('/contact') }}">Kontak</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
