@extends('layouts.mazer')

@section('title', 'Kategori Alat Laboratorium')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Kategori Alat Laboratorium</h3>
            <p class="text-subtitle text-muted">Pengelompokan alat dan inventaris laboratorium.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Kategori</h4>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">NO</th>
                            <th>NAMA KATEGORI</th>
                            <th>DESKRIPSI</th>
                            <th>JUMLAH ALAT</th>
                            <th class="text-center" style="width: 150px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $index => $kategori)
                            <tr>
                                <td>{{ $kategoris->firstItem() + $index }}</td>
                                <td class="fw-bold">{{ $kategori->nama_kategori }}</td>
                                <td class="text-muted">{{ $kategori->deskripsi ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-light-primary text-primary">{{ $kategori->alats_count ?? $kategori->alats->count() }} Alat</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada kategori alat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
