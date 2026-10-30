@extends('layouts.master')

@section('title', 'Data Alat Laboratorium (SiLab)')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Alat Laboratorium (SiLab)</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Hoverable rows start -->
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Alat Laboratorium</h4>
                        <a href="{{ route('alat.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Alat
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p>Berikut adalah inventaris alat dan instrumen yang tersedia di laboratorium SiLab.</p>
                            <!-- Search & Filter -->
                            <form action="{{ url('data-barang') }}" method="GET" class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode alat..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                                </div>
                            </form>
                        </div>
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>KODE</th>
                                        <th>NAMA ALAT</th>
                                        <th>KATEGORI</th>
                                        <th>TOTAL</th>
                                        <th>TERSEDIA</th>
                                        <th>KONDISI</th>
                                        <th>STATUS</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($alat as $index => $item)
                                        <tr>
                                            <td class="text-bold-500">{{ $alat->firstItem() + $index }}</td>
                                            <td><span class="badge bg-light-secondary text-dark">{{ $item->kode_alat }}</span></td>
                                            <td class="fw-bold">{{ $item->nama_alat }}</td>
                                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                            <td>{{ $item->jumlah_total }}</td>
                                            <td>
                                                <span class="badge {{ $item->jumlah_tersedia > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->jumlah_tersedia }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($item->kondisi == 'baik')
                                                    <span class="badge bg-light-success text-success">Baik</span>
                                                @elseif($item->kondisi == 'rusak_ringan')
                                                    <span class="badge bg-light-warning text-warning">Rusak Ringan</span>
                                                @else
                                                    <span class="badge bg-light-danger text-danger">Rusak Berat</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 'tersedia')
                                                    <span class="badge bg-success">Tersedia</span>
                                                @elseif($item->status == 'dipinjam')
                                                    <span class="badge bg-warning">Dipinjam</span>
                                                @else
                                                    <span class="badge bg-secondary">Maintenance</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('alat.show', $item) }}" class="btn btn-sm btn-info text-white" title="Detail">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('alat.edit', $item) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('alat.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus alat ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">Belum ada data alat laboratorium.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3">
                            {{ $alat->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->
</div>
@endsection
