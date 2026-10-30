@extends('layouts.mazer')

@section('title', 'Detail Alat - ' . $alat->nama_alat)

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Detail Alat Laboratorium</h3>
            <p class="text-subtitle text-muted">Informasi lengkap spesifikasi dan ketersediaan: <strong>{{ $alat->nama_alat }}</strong></p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('alat.index') }}">Data Alat</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body text-center p-4">
                    @if($alat->gambar)
                        <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="img-fluid rounded mb-3" style="max-height: 280px; object-fit: cover;">
                    @else
                        <div class="bg-light py-5 rounded mb-3 text-secondary">
                            <i class="bi bi-camera fs-1 d-block mb-2"></i>
                            <span>Tidak ada foto</span>
                        </div>
                    @endif
                    <h4 class="mb-1">{{ $alat->nama_alat }}</h4>
                    <span class="badge bg-light-primary text-primary font-monospace fs-6">{{ $alat->kode_alat }}</span>
                    <div class="mt-3">
                        <span class="badge bg-secondary">{{ $alat->kategori->nama_kategori ?? '-' }}</span>
                        @if($alat->kondisi == 'baik')
                            <span class="badge bg-success">Kondisi Baik</span>
                        @elseif($alat->kondisi == 'rusak_ringan')
                            <span class="badge bg-warning">Rusak Ringan</span>
                        @else
                            <span class="badge bg-danger">Rusak Berat</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Informasi Ketersediaan</h4>
                    <div>
                        <a href="{{ route('alat.edit', $alat->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
                        <a href="{{ route('alat.index') }}" class="btn btn-sm btn-light-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Total Stok:</span>
                            <span class="fw-bold">{{ $alat->stok }} Unit</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Stok Tersedia (Siap Dipinjam):</span>
                            <span class="badge bg-success fs-6">{{ $alat->stok_tersedia }} Unit</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Sedang Dipinjam:</span>
                            <span class="badge bg-primary fs-6">{{ $alat->stok - $alat->stok_tersedia }} Unit</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Lokasi Penyimpanan:</span>
                            <span>{{ $alat->lokasi ?? 'Laboratorium Utama' }}</span>
                        </li>
                    </ul>

                    <h6>Deskripsi / Spesifikasi:</h6>
                    <p class="text-muted">{{ $alat->deskripsi ?? 'Tidak ada deskripsi detail untuk alat ini.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
