@extends('layouts.mazer')

@section('title', 'Detail Peminjaman - ' . $peminjaman->kode_peminjaman)

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Detail Peminjaman Alat</h3>
            <p class="text-subtitle text-muted">Kode Transaksi: <strong>{{ $peminjaman->kode_peminjaman }}</strong></p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $peminjaman->kode_peminjaman }}</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Status &amp; Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <span class="text-muted d-block small">STATUS PEMINJAMAN</span>
                        @if($peminjaman->status == 'menunggu')
                            <span class="badge bg-warning fs-6 px-3 py-2 mt-1">Menunggu Persetujuan</span>
                        @elseif($peminjaman->status == 'disetujui')
                            <span class="badge bg-info text-white fs-6 px-3 py-2 mt-1">Disetujui</span>
                        @elseif($peminjaman->status == 'dipinjam')
                            <span class="badge bg-primary fs-6 px-3 py-2 mt-1">Sedang Dipinjam</span>
                        @elseif($peminjaman->status == 'dikembalikan')
                            <span class="badge bg-success fs-6 px-3 py-2 mt-1">Sudah Dikembalikan</span>
                        @else
                            <span class="badge bg-danger fs-6 px-3 py-2 mt-1">{{ ucfirst($peminjaman->status) }}</span>
                        @endif
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted">Peminjam:</span>
                            <span class="fw-bold">{{ $peminjaman->user->name ?? '-' }}</span>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted">Email:</span>
                            <span>{{ $peminjaman->user->email ?? '-' }}</span>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted">Tgl Mulai:</span>
                            <span>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->translatedFormat('d M Y') }}</span>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted">Rencana Kembali:</span>
                            <span>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->translatedFormat('d M Y') }}</span>
                        </li>
                        @if($peminjaman->tanggal_kembali_aktual)
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Kembali Aktual:</span>
                                <span class="text-success fw-bold">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_aktual)->translatedFormat('d M Y H:i') }}</span>
                            </li>
                        @endif
                    </ul>

                    <div class="mt-3">
                        <span class="text-muted d-block small">KEPERLUAN:</span>
                        <p class="mb-0 bg-light p-2 rounded small">{{ $peminjaman->keperluan }}</p>
                    </div>

                    @if(auth()->user()->is_admin)
                        <hr>
                        <h6 class="mb-3">Aksi Admin</h6>
                        @if($peminjaman->status == 'menunggu')
                            <div class="d-flex gap-2">
                                <form action="{{ route('peminjaman.approve', $peminjaman->id) }}" method="POST" class="w-50">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100"><i class="bi bi-check-circle"></i> Setujui</button>
                                </form>
                                <form action="{{ route('peminjaman.reject', $peminjaman->id) }}" method="POST" class="w-50">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100"><i class="bi bi-x-circle"></i> Tolak</button>
                                </form>
                            </div>
                        @elseif($peminjaman->status == 'disetujui')
                            <form action="{{ route('peminjaman.mark-as-borrowed', $peminjaman->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-box-arrow-right"></i> Serahkan Alat (Mulai Pinjam)</button>
                            </form>
                        @elseif($peminjaman->status == 'dipinjam')
                            <form action="{{ route('peminjaman.return', $peminjaman->id) }}" method="POST">
                                @csrf
                                @foreach($peminjaman->details as $d)
                                    <input type="hidden" name="kondisi_sesudah[{{ $d->id }}]" value="baik">
                                @endforeach
                                <button type="submit" class="btn btn-success w-100" onclick="return confirm('Konfirmasi pengembalian semua alat?')">
                                    <i class="bi bi-check-all"></i> Konfirmasi Pengembalian
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Alat yang Dipinjam</h5>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-light-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>NO</th>
                                    <th>KODE</th>
                                    <th>NAMA ALAT</th>
                                    <th>KATEGORI</th>
                                    <th>JUMLAH</th>
                                    <th>KONDISI AWAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman->details as $idx => $detail)
                                    <tr>
                                        <td>{{ $idx + 1 }}</td>
                                        <td><span class="badge bg-light-primary text-primary font-monospace">{{ $detail->alat->kode_alat ?? '-' }}</span></td>
                                        <td class="fw-bold">{{ $detail->alat->nama_alat ?? '-' }}</td>
                                        <td><span class="badge bg-secondary">{{ $detail->alat->kategori->nama_kategori ?? '-' }}</span></td>
                                        <td><span class="badge bg-dark">{{ $detail->jumlah }} Unit</span></td>
                                        <td>
                                            <span class="badge bg-light-success text-success">{{ ucfirst(str_replace('_', ' ', $detail->kondisi_sebelum ?? 'baik')) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
