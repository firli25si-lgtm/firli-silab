@extends('layouts.mazer')

@section('title', 'Edit Alat - ' . $alat->nama_alat)

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Edit Alat Laboratorium</h3>
            <p class="text-subtitle text-muted">Perbarui informasi, stok, atau kondisi alat: <strong>{{ $alat->nama_alat }}</strong></p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('alat.index') }}">Data Alat</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Perbarui Data Alat</h4>
            <span class="badge bg-light-primary text-primary font-monospace">{{ $alat->kode_alat }}</span>
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

            <form action="{{ route('alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_alat" class="form-label">Nama Alat <span class="text-danger">*</span></label>
                        <input type="text" id="nama_alat" name="nama_alat" class="form-control" value="{{ old('nama_alat', $alat->nama_alat) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select id="kategori_id" name="kategori_id" class="form-select" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="stok" class="form-label">Total Stok <span class="text-danger">*</span></label>
                        <input type="number" id="stok" name="stok" class="form-control" value="{{ old('stok', $alat->stok) }}" min="0" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="stok_tersedia" class="form-label">Stok Tersedia <span class="text-danger">*</span></label>
                        <input type="number" id="stok_tersedia" name="stok_tersedia" class="form-control" value="{{ old('stok_tersedia', $alat->stok_tersedia) }}" min="0" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="kondisi" class="form-label">Kondisi Alat <span class="text-danger">*</span></label>
                        <select id="kondisi" name="kondisi" class="form-select" required>
                            <option value="baik" {{ old('kondisi', $alat->kondisi) == 'baik' ? 'selected' : '' }}>Baik (Siap Pakai)</option>
                            <option value="rusak_ringan" {{ old('kondisi', $alat->kondisi) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan (Perlu Perbaikan)</option>
                            <option value="rusak_berat" {{ old('kondisi', $alat->kondisi) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat (Tidak Berfungsi)</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="lokasi" class="form-label">Lokasi Penyimpanan</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control" value="{{ old('lokasi', $alat->lokasi) }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi &amp; Spesifikasi Alat</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="gambar" class="form-label">Foto Alat (Biarkan kosong jika tidak diubah)</label>
                        @if($alat->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $alat->gambar) }}" alt="Foto Alat" class="img-thumbnail" style="max-height: 120px;">
                            </div>
                        @endif
                        <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('alat.index') }}" class="btn btn-light-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui Alat</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
