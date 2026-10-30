<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tim Pengelola Lab - SiLab</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('img/silab-icon.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
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
            <h1 class="display-3 text-white mb-4 animated slideInDown fw-bold">Pengelola Laboratorium</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Tim Petugas Lab</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">PENGELOLA &amp; ASISTEN</p>
                <h1 class="display-6 mb-5 fw-bold">Petugas Laboratorium SiLab</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-4">
                        <div class="btn-square bg-light rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fa fa-user-tie fa-2x text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Dr. Hendra Gunawan, S.T., M.T.</h5>
                        <p class="text-primary small mb-3">Kepala Laboratorium Terpadu</p>
                        <p class="text-muted small">Penanggung jawab kebijakan peminjaman alat, kalibrasi, dan pengadaan instrumen praktikum.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-4">
                        <div class="btn-square bg-light rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fa fa-user-cog fa-2x text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Bambang Sutejo, A.Md.</h5>
                        <p class="text-primary small mb-3">Pranata Laboratorium Pendidikan (PLP)</p>
                        <p class="text-muted small">Verifikator status fisik barang (Kondisi Baik/Rusak) dan penanggung jawab master data alat.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-4">
                        <div class="btn-square bg-light rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fa fa-user-graduate fa-2x text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Nadia Safitri, S.T.</h5>
                        <p class="text-primary small mb-3">Koordinator Asisten Laboratorium</p>
                        <p class="text-muted small">Membantu sirkulasi peminjaman harian mahasiswa, serah terima alat, dan pendampingan praktikum.</p>
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
