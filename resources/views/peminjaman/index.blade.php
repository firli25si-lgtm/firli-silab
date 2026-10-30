@extends('layouts.mazer')

@section('title', 'Transaksi Peminjaman Alat')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Transaksi Peminjaman Alat</h3>
            <p class="text-subtitle text-muted">Daftar permohonan dan riwayat peminjaman alat laboratorium.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h4 class="card-title mb-0">Riwayat &amp; Permohonan Peminjaman</h4>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Ajukan Peminjaman Baru
            </a>
        </div>
        <div class="card-body">
            <!-- Filter Bar -->
            <form method="GET" action="{{ route('peminjaman.index') }}" class="row g-3 mb-4">
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                        <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="dari_tanggal" class="form-control" value="{{ request('dari_tanggal') }}" placeholder="Dari Tanggal">
                </div>
                <div class="col-md-3">
                    <input type="date" name="sampai_tanggal" class="form-control" value="{{ request('sampai_tanggal') }}" placeholder="Sampai Tanggal">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                    @if(request()->hasAny(['status', 'dari_tanggal', 'sampai_tanggal']))
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-light-secondary"><i class="bi bi-arrow-counterclockwise"></i></a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-lg align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">NO</th>
                            <th>KODE PINJAM</th>
                            <th>PEMINJAM</th>
                            <th>TGL PINJAM</th>
                            <th>RENCANA KEMBALI</th>
                            <th>STATUS</th>
                            <th class="text-center" style="width: 140px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjamen as $index => $item)
                            <tr>
                                <td>{{ $peminjamen->firstItem() + $index }}</td>
                                <td><span class="badge bg-light-secondary text-dark font-monospace">{{ $item->kode_peminjaman }}</span></td>
                                <td class="fw-bold">{{ $item->user->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali_rencana)->translatedFormat('d M Y') }}</td>
                                <td>
                                    @if($item->status == 'menunggu')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($item->status == 'disetujui')
                                        <span class="badge bg-info text-white">Disetujui</span>
                                    @elseif($item->status == 'dipinjam')
                                        <span class="badge bg-primary">Dipinjam</span>
                                    @elseif($item->status == 'dikembalikan')
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-danger">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('peminjaman.show', $item->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="bi bi-clipboard-x fs-1 d-block mb-2 text-secondary"></i>
                                    Belum ada transaksi peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $peminjamen->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
