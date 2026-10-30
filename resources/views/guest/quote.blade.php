<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Formulir Peminjaman Alat - SiLab</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Formulir Peminjaman Alat, SiLab, Peminjaman Online Lab" name="keywords">
    <meta content="Formulir Pengajuan Peminjaman Peralatan Laboratorium Kampus SiLab" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/silab-icon.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
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
                <a href="{{ url('/contact') }}" class="nav-item nav-link">Kontak &amp; Lokasi</a>
            </div>
            <div class="d-flex align-items-center pe-lg-4 py-2 py-lg-0">
                <a href="{{ url('/') }}" class="btn btn-primary px-3 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="fa fa-home me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown fw-bold">Formulir Peminjaman Alat</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Formulir Peminjaman</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Form Peminjaman Container -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-light rounded-3 p-4 p-sm-5 shadow-sm border">
                        <div class="text-center mb-4">
                            <span class="badge bg-primary px-3 py-2 rounded-pill mb-2"><i class="fa fa-file-signature me-1"></i> RESMI &amp; TERPADU</span>
                            <h2 class="fw-bold">Pengajuan Peminjaman Alat Laboratorium</h2>
                            <p class="text-muted small">Pengajuan Anda akan diteruskan secara otomatis ke Petugas Laboratorium untuk proses verifikasi (Approve/Reject).</p>
                        </div>

                        <form id="dedicatedLoanForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">Nama Lengkap Mahasiswa *</label>
                                    <input type="text" class="form-control" id="mName" placeholder="Contoh: Firli Aditia" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">Nomor Induk Mahasiswa (NIM) *</label>
                                    <input type="text" class="form-control" id="mNim" placeholder="Contoh: 230102045" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">Program Studi *</label>
                                    <select class="form-select" id="mMajor" required>
                                        <option value="" selected disabled>Pilih Jurusan...</option>
                                        <option value="Teknik Informatika">Teknik Informatika</option>
                                        <option value="Teknik Elektro">Teknik Elektro</option>
                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                        <option value="Teknik Komputer">Teknik Komputer</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">No. Kontak WhatsApp *</label>
                                    <input type="tel" class="form-control" id="mPhone" placeholder="0812-xxxx-xxxx" required>
                                </div>

                                <div class="col-sm-8">
                                    <label class="form-label small fw-bold">Pilihan Alat Laboratorium *</label>
                                    <select class="form-select" id="mTool" required>
                                        <option value="" selected disabled>Pilih Alat...</option>
                                        <option value="Oscilloscope Digital 100MHz (ELK-OSC-01)">Oscilloscope Digital 100MHz (ELK-OSC-01)</option>
                                        <option value="Function Generator DDS 25MHz (ELK-GEN-02)">Function Generator DDS 25MHz (ELK-GEN-02)</option>
                                        <option value="Digital Multimeter True RMS (ELK-DMM-03)">Digital Multimeter True RMS (ELK-DMM-03)</option>
                                        <option value="DC Regulated Power Supply 30V 5A (ELK-PWR-04)">DC Regulated Power Supply 30V 5A (ELK-PWR-04)</option>
                                        <option value="Sensor Ultrasonik HC-SR04 (SNS-ULT-01)">Sensor Ultrasonik HC-SR04 (SNS-ULT-01)</option>
                                        <option value="Gyroscope &amp; Accelerometer MPU-6050 (SNS-MPU-02)">Gyroscope &amp; Accelerometer MPU-6050 (SNS-MPU-02)</option>
                                        <option value="Sensor Suhu &amp; Kelembaban DHT22 (SNS-DHT-03)">Sensor Suhu &amp; Kelembaban DHT22 (SNS-DHT-03)</option>
                                        <option value="Sensor Gas &amp; Asap MQ-2 (SNS-MQ2-04)">Sensor Gas &amp; Asap MQ-2 (SNS-MQ2-04)</option>
                                        <option value="Digital Soldering Station ESD 60W (TLS-SLD-01)">Digital Soldering Station ESD 60W (TLS-SLD-01)</option>
                                        <option value="Crimping Tool Kit RJ45/RJ11 (TLS-CRP-02)">Crimping Tool Kit RJ45/RJ11 (TLS-CRP-02)</option>
                                        <option value="Precision Wire Stripper Pro (TLS-WST-03)">Precision Wire Stripper Pro (TLS-WST-03)</option>
                                        <option value="Logic Analyzer 24MHz 8CH USB (TLS-LGC-04)">Logic Analyzer 24MHz 8CH USB (TLS-LGC-04)</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label small fw-bold">Jumlah Unit *</label>
                                    <input type="number" class="form-control" id="mQty" value="1" min="1" max="5" required>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">Tanggal Peminjaman *</label>
                                    <input type="date" class="form-control" id="mStart" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">Tanggal Pengembalian *</label>
                                    <input type="date" class="form-control" id="mEnd" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-bold">Keperluan Peminjaman *</label>
                                    <select class="form-select" id="mPurpose" required>
                                        <option value="" selected disabled>Pilih Keperluan...</option>
                                        <option value="Praktikum Terjadwal Kampus">Praktikum Terjadwal Kampus</option>
                                        <option value="Tugas Akhir / Skripsi">Tugas Akhir / Skripsi</option>
                                        <option value="Riset Proyek Dosen">Riset Proyek Dosen</option>
                                        <option value="Lomba Inovasi Mahasiswa">Lomba Inovasi Mahasiswa</option>
                                    </select>
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <button class="btn btn-primary py-3 px-5 rounded-pill fw-bold w-100 shadow" type="submit">
                                        <i class="fa fa-paper-plane me-2"></i>Kirim Pengajuan Peminjaman
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('mStart').value = today;
        var next3 = new Date(Date.now() + 3*24*60*60*1000).toISOString().split('T')[0];
        document.getElementById('mEnd').value = next3;

        document.getElementById('dedicatedLoanForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Pengajuan peminjaman berhasil dikirim ke Petugas Lab!\nAnda akan diarahkan kembali ke beranda untuk melihat struk bukti peminjaman.');
            window.location.href = "{{ url('/#katalog') }}";
        });
    </script>
</body>

</html>
