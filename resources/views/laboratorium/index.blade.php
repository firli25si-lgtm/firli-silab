@extends('layouts.mazer')

@section('title', 'Data Laboratorium')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Laboratorium</h3>
                <p class="text-subtitle text-muted">Kelola data ruang dan laboratorium kampus</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laboratorium</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">
                    <i class="bi bi-building me-2 text-primary"></i>Daftar Laboratorium
                </h4>
                <a href="{{ route('laboratorium.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Lab
                </a>
            </div>
            <div class="card-body">
                @if ($laboratoriums->count())
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode Lab</th>
                                    <th>Nama Laboratorium</th>
                                    <th>Lokasi</th>
                                    <th>Kapasitas</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Status</th>
                                    <th>Jadwal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laboratoriums as $lab)
                                    <tr>
                                        <td>{{ $laboratoriums->firstItem() + $loop->index }}</td>
                                        <td><span class="badge bg-secondary">{{ $lab->kode_lab }}</span></td>
                                        <td class="fw-semibold">{{ $lab->nama_lab }}</td>
                                        <td><i class="bi bi-geo-alt text-muted me-1"></i>{{ $lab->lokasi }}</td>
                                        <td><i class="bi bi-people me-1 text-muted"></i>{{ $lab->kapasitas }} orang</td>
                                        <td>{{ $lab->penanggung_jawab }}</td>
                                        <td>
                                            <span class="{{ $lab->statusBadgeClass() }}">
                                                {{ ucfirst($lab->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $lab->jadwals_count }} jadwal
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('laboratorium.show', $lab->id) }}"
                                               class="btn btn-sm btn-outline-info" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('laboratorium.edit', $lab->id) }}"
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('laboratorium.destroy', $lab->id) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Hapus laboratorium {{ $lab->nama_lab }}? Semua jadwal terkait juga akan dihapus.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $laboratoriums->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-building fs-1 text-muted"></i>
                        <p class="mt-3 text-muted">Belum ada data laboratorium.</p>
                        <a href="{{ route('laboratorium.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>Tambah Laboratorium Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
