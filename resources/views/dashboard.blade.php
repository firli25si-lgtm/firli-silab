@extends('layouts.mazer')

@section('title', 'Dashboard Utama SiLab')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Dashboard Utama SiLab</h3>
            <p class="text-subtitle text-muted">Ringkasan status inventaris dan aktivitas peminjaman laboratorium kampus.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="row">
    <div class="col-12 col-lg-9">
        <div class="row">
            <!-- Total Barang -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Total Barang</h6>
                                <h6 class="font-extrabold mb-0">{{ $stokTotal ?? 150 }} <small class="text-muted font-normal" style="font-size: 11px;">Unit</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Barang Dipinjam -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Dipinjam</h6>
                                <h6 class="font-extrabold mb-0">{{ $peminjamanAktif ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Barang Tersedia -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Tersedia</h6>
                                <h6 class="font-extrabold mb-0">{{ $stokTersedia ?? 120 }} <small class="text-muted font-normal" style="font-size: 11px;">Unit</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Barang Rusak / Perlu Perbaikan -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Perlu Perbaikan</h6>
                                <h6 class="font-extrabold mb-0">{{ $stokRusak ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Statistik -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Statistik Penggunaan Lab &amp; Ketersediaan Alat</h4>
                        <span class="badge bg-light-primary text-primary">Tahun Akademik {{ date('Y') }}</span>
                    </div>
                    <div class="card-body">
                        <div id="chart-profile-visit"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Alat Terkini -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Inventaris Alat Terbaru</h4>
                        <a href="{{ route('alat.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Alat <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Alat</th>
                                        <th>Kategori</th>
                                        <th>Stok Tersedia</th>
                                        <th>Kondisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($alatTerbaru as $alat)
                                        <tr>
                                            <td class="text-bold-500"><span class="badge bg-light-secondary text-dark">{{ $alat->kode_alat }}</span></td>
                                            <td class="text-bold-500">{{ $alat->nama_alat }}</td>
                                            <td>{{ $alat->kategori->nama_kategori ?? '-' }}</td>
                                            <td><span class="fw-bold">{{ $alat->stok_tersedia }}</span> / {{ $alat->stok }} Unit</td>
                                            <td>
                                                @if(strtolower($alat->kondisi) == 'baik')
                                                    <span class="badge bg-success">Baik</span>
                                                @elseif(strtolower($alat->kondisi) == 'rusak')
                                                    <span class="badge bg-danger">Rusak</span>
                                                @else
                                                    <span class="badge bg-warning">Perlu Perbaikan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('alat.edit', $alat->id) }}" class="btn btn-sm btn-light-warning"><i class="bi bi-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">Belum ada data alat laboratorium.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan (Profil & Info) -->
    <div class="col-12 col-lg-3">
        <!-- User Profile Card -->
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 54px; height: 54px; border-radius: 50%; font-size: 20px;">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold mb-0">{{ Auth::user()->name ?? 'Pengguna' }}</h5>
                        <small class="text-muted">{{ Auth::user()->email ?? '-' }}</small>
                        <div class="mt-1">
                            <span class="badge bg-primary" style="font-size: 11px;">{{ Auth::user()->is_admin ? 'Admin Laboratorium' : 'Mahasiswa' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi / Aktivitas Lab -->
        <div class="card">
            <div class="card-header">
                <h4>Notifikasi Lab</h4>
            </div>
            <div class="card-content pb-4">
                @forelse ($peminjamanTerbaru as $pjm)
                    <div class="recent-message d-flex px-4 py-3 border-bottom">
                        <div class="avatar avatar-md bg-light-primary text-primary d-flex align-items-center justify-content-center fw-bold rounded-circle" style="width: 40px; height: 40px;">
                            {{ strtoupper(substr($pjm->user->name ?? 'M', 0, 1)) }}
                        </div>
                        <div class="name ms-3">
                            <h6 class="mb-0 fw-bold">{{ $pjm->user->name ?? 'Mahasiswa' }}</h6>
                            <small class="text-muted d-block">Kode: {{ $pjm->kode_peminjaman }}</small>
                            <span class="badge bg-{{ $pjm->status == 'dipinjam' ? 'primary' : ($pjm->status == 'dikembalikan' ? 'success' : 'warning') }} mt-1" style="font-size: 10px;">
                                {{ ucfirst($pjm->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="px-4 py-3 text-muted text-center small">
                        Belum ada transaksi peminjaman terbaru.
                    </div>
                @endforelse
                <div class="px-4 mt-3">
                    <a href="{{ route('peminjaman.index') }}" class='btn btn-block btn-light-primary font-bold w-100'>Lihat Semua Transaksi</a>
                </div>
            </div>
        </div>

        <!-- Ringkasan Kategori -->
        <div class="card">
            <div class="card-header">
                <h4>Status Alat</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success p-2 rounded-circle me-2"> </span>
                        <span>Kondisi Baik</span>
                    </div>
                    <span class="fw-bold">{{ $stokTersedia }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-warning p-2 rounded-circle me-2"> </span>
                        <span>Sedang Dipinjam</span>
                    </div>
                    <span class="fw-bold">{{ $peminjamanAktif }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-danger p-2 rounded-circle me-2"> </span>
                        <span>Perlu Perbaikan</span>
                    </div>
                    <span class="fw-bold">{{ $stokRusak }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    var optionsProfileVisit = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled:false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity:1
        },
        plotOptions: {
        },
        series: [{
            name: 'Peminjaman Alat',
            data: [9, 20, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20]
        }],
        colors: '#435ebe',
        xaxis: {
            categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
        },
    }
    var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
    chartProfileVisit.render();
</script>
@endpush
