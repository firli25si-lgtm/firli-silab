@extends('layouts.mazer')

@section('title', 'Data Alat Laboratorium')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Alat Laboratorium</h3>
            <p class="text-subtitle text-muted">Kelola inventaris seluruh peralatan dan aset laboratorium kampus.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Alat</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h4 class="card-title mb-0">Daftar Alat Laboratorium (SiLab)</h4>
            <a href="{{ route('alat.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Alat Baru
            </a>
        </div>
        <div class="card-body">
            <!-- Filter & Search Bar -->
            <form method="GET" action="{{ route('alat.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode alat..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="kategori_id" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="kondisi" class="form-select">
                        <option value="">-- Semua Kondisi --</option>
                        <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak_ringan" {{ request('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="rusak_berat" {{ request('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                    @if(request()->hasAny(['search', 'kategori_id', 'kondisi']))
                        <a href="{{ route('alat.index') }}" class="btn btn-light-secondary"><i class="bi bi-arrow-counterclockwise"></i></a>
                    @endif
                </div>
            </form>

            <!-- Table with outer spacing -->
            <div class="table-responsive">
                <table class="table table-hover table-lg align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">NO</th>
                            <th>KODE</th>
                            <th>NAMA ALAT</th>
                            <th>KATEGORI</th>
                            <th>STOK</th>
                            <th>KONDISI</th>
                            <th>LOKASI</th>
                            <th class="text-center" style="width: 150px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alats as $index => $item)
                            <tr>
                                <td class="text-bold-500">{{ $alats->firstItem() + $index }}</td>
                                <td><span class="badge bg-light-primary text-primary font-monospace">{{ $item->kode_alat }}</span></td>
                                <td class="fw-bold">
                                    <a href="{{ route('alat.show', $item->id) }}" class="text-dark">
                                        {{ $item->nama_alat }}
                                    </a>
                                </td>
                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->stok_tersedia > 0 ? 'success' : 'secondary' }}">
                                        {{ $item->stok_tersedia }} / {{ $item->stok }} Unit
                                    </span>
                                </td>
                                <td>
                                    @if($item->kondisi == 'baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($item->kondisi == 'rusak_ringan')
                                        <span class="badge bg-warning">Rusak Ringan</span>
                                    @else
                                        <span class="badge bg-danger">Rusak Berat</span>
                                    @endif
                                </td>
                                <td>{{ $item->lokasi ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('alat.show', $item->id) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('alat.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('alat.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
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
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    Tidak ada data alat yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $alats->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
