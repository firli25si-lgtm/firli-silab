@extends('layouts.mazer')

@section('title', 'Jadwal Praktikum')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Jadwal Praktikum</h3>
                <p class="text-subtitle text-muted">Kelola jadwal penggunaan laboratorium</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jadwal Praktikum</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="page-content">
    <section class="section">

        {{-- Filter & Search --}}
        <div class="card mb-3">
            <div class="card-body py-2">
                <form method="GET" action="{{ route('jadwal-praktikum.index') }}" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small mb-1">Cari Mata Kuliah / Dosen / Lab</label>
                        <input type="text" name="search" class="form-control form-control-sm"
                               value="{{ request('search') }}" placeholder="Ketik untuk mencari...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small mb-1">Filter Hari</label>
                        <select name="hari" class="form-select form-select-sm">
                            <option value="">— Semua Hari —</option>
                            @foreach ($hariList as $hari)
                                <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small mb-1">Filter Laboratorium</label>
                        <select name="lab" class="form-select form-select-sm">
                            <option value="">— Semua Lab —</option>
                            @foreach ($labs as $lab)
                                <option value="{{ $lab->id }}" {{ request('lab') == $lab->id ? 'selected' : '' }}>
                                    {{ $lab->kode_lab }} - {{ $lab->nama_lab }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-1">
                        <button type="submit" class="btn btn-primary btn-sm flex-fill">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="{{ route('jadwal-praktikum.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-x"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">
                    <i class="bi bi-calendar-week me-2 text-primary"></i>Daftar Jadwal
                    <span class="badge bg-secondary ms-1">{{ $jadwals->total() }} data</span>
                </h4>
                <a href="{{ route('jadwal-praktikum.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Jadwal
                </a>
            </div>
            <div class="card-body">
                @if ($jadwals->count())
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Laboratorium</th>
                                    <th>Mata Kuliah</th>
                                    <th>Dosen Pengampu</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Kapasitas</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $jadwals->firstItem() + $loop->index }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $jadwal->kode_lab }}</span><br>
                                            <small class="text-muted">{{ $jadwal->nama_lab }}</small>
                                        </td>
                                        <td class="fw-semibold">{{ $jadwal->mata_kuliah }}</td>
                                        <td>{{ $jadwal->dosen_pengampu }}</td>
                                        <td><span class="badge bg-light-primary text-primary">{{ $jadwal->hari }}</span></td>
                                        <td>
                                            <i class="bi bi-clock text-muted me-1"></i>
                                            {{ substr($jadwal->jam_mulai, 0, 5) }} – {{ substr($jadwal->jam_selesai, 0, 5) }}
                                        </td>
                                        <td>{{ $jadwal->kapasitas_peserta }} org</td>
                                        <td>{{ $jadwal->keterangan ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('jadwal-praktikum.edit', $jadwal->id) }}"
                                               class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('jadwal-praktikum.destroy', $jadwal->id) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Hapus jadwal {{ $jadwal->mata_kuliah }}?')">
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
                    <div class="mt-3">
                        {{ $jadwals->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x fs-1 text-muted"></i>
                        <p class="mt-3 text-muted">Belum ada jadwal atau tidak ada hasil pencarian.</p>
                        <a href="{{ route('jadwal-praktikum.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>Tambah Jadwal Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </section>
</div>
@endsection
