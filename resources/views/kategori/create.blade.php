@extends('layouts.mazer')

@section('title', 'Tambah Kategori')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tambah Kategori Alat</h3>
            <p class="text-subtitle text-muted">Buat kategori baru untuk pengelompokan alat lab.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
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
            <h4 class="card-title">Formulir Kategori Baru</h4>
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

            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}" placeholder="Contoh: Optik, Kimia, Elektronika" required>
                </div>

                <div class="form-group mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi singkat kategori alat...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('kategori.index') }}" class="btn btn-light-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
