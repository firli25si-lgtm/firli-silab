@extends('layouts.mazer')

@section('title', $laboratorium->nama_lab)

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $laboratorium->nama_lab }}</h3>
                <p class="text-subtitle text-muted">Detail laboratorium &amp; jadwal praktikum</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('laboratorium.index') }}">Laboratorium</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="page-content">
    <section class="section">

        {{-- Info Lab --}}
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar bg-light-primary p-3 me-3 rounded">
                                <i class="bi bi-building fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $laboratorium->nama_lab }}</h4>
                                <span class="badge bg-secondary">{{ $laboratorium->kode_lab }}</span>
                                <span class="{{ $laboratorium->statusBadgeClass() }} ms-1">{{ ucfirst($laboratorium->status) }}</span>
                            </div>
                        </div>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td class="text-muted fw-semibold" width="180"><i class="bi bi-geo-alt me-1"></i>Lokasi</td>
                                <td>{{ $laboratorium->lokasi }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold"><i class="bi bi-people me-1"></i>Kapasitas</td>
                                <td>{{ $laboratorium->kapasitas }} orang</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold"><i class="bi bi-person-badge me-1"></i>Penanggung Jawab</td>
                                <td>{{ $laboratorium->penanggung_jawab }}</td>
                            </tr>
                            @if ($laboratorium->deskripsi)
                            <tr>
                                <td class="text-muted fw-semibold"><i class="bi bi-info-circle me-1"></i>Deskripsi</td>
                                <td>{{ $laboratorium->deskripsi }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-primary">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="bi bi-calendar-week fs-1 text-primary mb-2"></i>
                        <h2 class="fw-bold text-primary">{{ $laboratorium->jadwals->count() }}</h2>
                        <p class="text-muted mb-3">Jadwal Praktikum Terdaftar</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('laboratorium.edit', $laboratorium->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil me-1"></i>Edit Lab
                            </a>
                            <a href="{{ route('jadwal-praktikum.create') }}?lab={{ $laboratorium->id }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle me-1"></i>Tambah Jadwal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jadwal Praktikum --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">
                    <i class="bi bi-calendar3 me-2 text-primary"></i>Jadwal Praktikum
                </h4>
                <a href="{{ route('jadwal-praktikum.index') }}" class="btn btn-sm btn-outline-primary">
                    Kelola Semua Jadwal
                </a>
            </div>
            <div class="card-body">
                @if ($laboratorium->jadwals->count())
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Mata Kuliah</th>
                                    <th>Dosen Pengampu</th>
                                    <th>Kapasitas</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laboratorium->jadwals as $jadwal)
                                    <tr>
                                        <td><span class="badge bg-light-primary text-primary">{{ $jadwal->hari }}</span></td>
                                        <td>{{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }}</td>
                                        <td class="fw-semibold">{{ $jadwal->mata_kuliah }}</td>
                                        <td>{{ $jadwal->dosen_pengampu }}</td>
                                        <td>{{ $jadwal->kapasitas_peserta }} org</td>
                                        <td>{{ $jadwal->keterangan ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('jadwal-praktikum.edit', $jadwal->id) }}"
                                               class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('jadwal-praktikum.destroy', $jadwal->id) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Hapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x fs-2 text-muted"></i>
                        <p class="text-muted mt-2">Belum ada jadwal untuk lab ini.</p>
                    </div>
                @endif
            </div>
        </div>

    </section>
</div>
@endsection
