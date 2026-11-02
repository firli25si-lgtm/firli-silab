<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>{{ $laboratorium->nama_lab }} - SiLab</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('img/silab-icon.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
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
                <span class="badge bg-{{ $laboratorium->status === 'aktif' ? 'success' : 'warning text-dark' }} px-3 py-1">
                    <i class="fa fa-door-{{ $laboratorium->status === 'aktif' ? 'open' : 'closed' }} me-1"></i>
                    {{ $laboratorium->status === 'aktif' ? 'Laboratorium Aktif' : 'Sedang Maintenance' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="{{ asset('img/silab-logo.png') }}" alt="SiLab Logo" style="height: 50px;" class="me-2">
            <div class="d-none d-sm-block text-start">
                <h2 class="m-0 fw-bold" style="color: #1E40AF; line-height: 1.1;">Si<span style="color: #10B981;">Lab</span></h2>
                <small class="text-muted" style="font-size: 11px; letter-spacing: 0.5px;">Inventaris &amp; Peminjaman Lab</small>
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
                <a href="{{ route('guest.laboratorium') }}" class="nav-item nav-link active">Laboratorium</a>
                <a href="{{ url('/contact') }}" class="nav-item nav-link">Kontak &amp; Lokasi</a>
            </div>
            <div class="d-flex align-items-center pe-lg-4 py-2 py-lg-0">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-3 py-2 rounded-pill fw-bold shadow-sm">
                        <i class="fa fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary px-3 py-2 rounded-pill fw-bold shadow-sm">
                        <i class="fa fa-sign-in-alt me-1"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white mb-3 animated slideInDown fw-bold">{{ $laboratorium->nama_lab }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('guest.laboratorium') }}" class="text-white">Laboratorium</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ $laboratorium->kode_lab }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-xxl py-4">
        <div class="container">

            <!-- Info Lab Card -->
            <div class="row g-4 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0 me-3 d-flex align-items-center justify-content-center rounded-circle text-white"
                                     style="width:70px;height:70px;font-size:2rem;background:linear-gradient(135deg,#0563bb,#1e40af);">
                                    <i class="fa fa-flask"></i>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-1">{{ $laboratorium->nama_lab }}</h3>
                                    <span class="badge bg-secondary me-1">{{ $laboratorium->kode_lab }}</span>
                                    @if ($laboratorium->status === 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Maintenance</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="fa fa-map-marker-alt text-primary mt-1 me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Lokasi</small>
                                            <span class="fw-semibold">{{ $laboratorium->lokasi }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="fa fa-users text-primary mt-1 me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Kapasitas</small>
                                            <span class="fw-semibold">{{ $laboratorium->kapasitas }} orang</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-start">
                                        <i class="fa fa-user-tie text-primary mt-1 me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Penanggung Jawab</small>
                                            <span class="fw-semibold">{{ $laboratorium->penanggung_jawab }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if ($laboratorium->deskripsi)
                                <div class="col-12">
                                    <div class="d-flex align-items-start">
                                        <i class="fa fa-info-circle text-primary mt-1 me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Deskripsi</small>
                                            <span>{{ $laboratorium->deskripsi }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center" style="background: linear-gradient(135deg,#0563bb,#1e40af);">
                        <div class="card-body d-flex flex-column justify-content-center p-4 text-white">
                            <i class="fa fa-calendar-alt fa-3x mb-3 opacity-75"></i>
                            <h1 class="display-4 fw-bold mb-1">{{ $jadwals->count() }}</h1>
                            <p class="mb-3 opacity-75">Jadwal Praktikum</p>
                            <a href="{{ route('guest.laboratorium') }}" class="btn btn-outline-light btn-sm">
                                <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar Lab
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Praktikum Section -->
            <div class="wow fadeInUp" data-wow-delay="0.2s">
                <div class="d-flex align-items-center mb-4">
                    <i class="fa fa-calendar-week fa-2x text-primary me-3"></i>
                    <div>
                        <h4 class="fw-bold mb-0">Jadwal Penggunaan Lab</h4>
                        <small class="text-muted">Data ditampilkan menggunakan Query Builder (leftJoin)</small>
                    </div>
                </div>

                @if ($jadwals->count())
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead style="background: linear-gradient(135deg,#0563bb,#1e40af); color: white;">
                                        <tr>
                                            <th class="px-4 py-3">Hari</th>
                                            <th class="py-3">Jam</th>
                                            <th class="py-3">Mata Kuliah</th>
                                            <th class="py-3">Dosen Pengampu</th>
                                            <th class="py-3">Kapasitas</th>
                                            <th class="py-3">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{--
                                            Partial View: @include('guest.partials.jadwal-row')
                                            Setiap baris jadwal di-render oleh partial terpisah
                                        --}}
                                        @foreach ($jadwals as $jadwal)
                                            @include('guest.partials.jadwal-row', ['jadwal' => $jadwal])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fa fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada jadwal untuk laboratorium ini.</h5>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 py-4 text-center">
        <small>&copy; {{ date('Y') }} SiLab - Sistem Informasi Inventaris &amp; Peminjaman Alat Lab.</small>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>new WOW().init();</script>
</body>

</html>
