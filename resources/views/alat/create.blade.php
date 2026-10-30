@extends('layouts.mazer')

@section('title', 'Tambah Alat Laboratorium')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tambah Alat Laboratorium</h3>
            <p class="text-subtitle text-muted">Daftarkan alat atau instrumen baru ke dalam sistem inventaris.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('alat.index') }}">Data Alat</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Formulir Pendaftaran Alat</h4>
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

            <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_alat" class="form-label">Nama Alat <span class="text-danger">*</span></label>
                        <input type="text" id="nama_alat" name="nama_alat" class="form-control" value="{{ old('nama_alat') }}" placeholder="Contoh: Mikroskop Binokuler XSZ-107BN" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select id="kategori_id" name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="stok" class="form-label">Jumlah Stok Total <span class="text-danger">*</span></label>
                        <input type="number" id="stok" name="stok" class="form-control" value="{{ old('stok', 1) }}" min="0" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="kondisi" class="form-label">Kondisi Alat <span class="text-danger">*</span></label>
                        <select id="kondisi" name="kondisi" class="form-select" required>
                            <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik (Siap Pakai)</option>
                            <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan (Perlu Perbaikan)</option>
                            <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat (Tidak Berfungsi)</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="lokasi" class="form-label">Lokasi Penyimpanan</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control" value="{{ old('lokasi') }}" placeholder="Contoh: Lemari A-1 / Ruang Lab Kimia">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi &amp; Spesifikasi Alat</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Tuliskan spesifikasi, panduan penggunaan, atau kelengkapan alat...">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="gambar" class="form-label">Foto Alat (Opsional)</label>
                        <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB.</small>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('alat.index') }}" class="btn btn-light-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Alat</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
