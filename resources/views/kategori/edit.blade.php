@extends('layouts.mazer')

@section('title', 'Edit Kategori - ' . $kategori->nama_kategori)

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Edit Kategori Alat</h3>
            <p class="text-subtitle text-muted">Perbarui kategori: <strong>{{ $kategori->nama_kategori }}</strong></p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Perbarui Data Kategori</h4>
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

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                </div>

                <div class="form-group mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('kategori.index') }}" class="btn btn-light-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui Kategori</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
