@extends('layouts.mazer')

@section('title', 'Ajukan Peminjaman Alat')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Ajukan Peminjaman Alat</h3>
            <p class="text-subtitle text-muted">Isi formulir untuk meminjam alat laboratorium.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Formulir Pengajuan Peminjaman</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST" id="form-peminjaman">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Mulai Pinjam <span class="text-danger">*</span></label>
                        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_kembali_rencana" class="form-label">Rencana Tanggal Pengembalian <span class="text-danger">*</span></label>
                        <input type="date" id="tanggal_kembali_rencana" name="tanggal_kembali_rencana" class="form-control" value="{{ old('tanggal_kembali_rencana', date('Y-m-d', strtotime('+3 days'))) }}" required>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="keperluan" class="form-label">Keperluan Peminjaman / Kegiatan Praktikum <span class="text-danger">*</span></label>
                        <textarea id="keperluan" name="keperluan" class="form-control" rows="2" placeholder="Contoh: Praktikum Mikrobiologi Modul 3 / Penelitian Skripsi" required>{{ old('keperluan') }}</textarea>
                    </div>
                </div>

                <h5 class="border-bottom pb-2 mb-3">Daftar Alat yang Dipinjam</h5>
                
                <div id="alat-container">
                    <div class="row g-3 align-items-end mb-3 alat-row">
                        <div class="col-md-7">
                            <label class="form-label">Pilih Alat Laboratorium</label>
                            <select name="alat_id[]" class="form-select" required>
                                <option value="">-- Pilih Alat --</option>
                                @foreach($alats as $alat)
                                    <option value="{{ $alat->id }}">
                                        {{ $alat->kode_alat }} - {{ $alat->nama_alat }} (Tersedia: {{ $alat->stok_tersedia }} Unit)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah[]" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-danger w-100 btn-remove-row" style="display: none;">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-row">
                        <i class="bi bi-plus"></i> Tambah Alat Lain
                    </button>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-light-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send me-1"></i> Ajukan Peminjaman</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.getElementById('btn-add-row').addEventListener('click', function() {
        var container = document.getElementById('alat-container');
        var firstRow = container.querySelector('.alat-row');
        var newRow = firstRow.cloneNode(true);
        newRow.querySelector('select').selectedIndex = 0;
        newRow.querySelector('input[type="number"]').value = 1;
        newRow.querySelector('.btn-remove-row').style.display = 'block';
        newRow.querySelector('.btn-remove-row').addEventListener('click', function() {
            newRow.remove();
        });
        container.appendChild(newRow);
    });
</script>
@endpush
