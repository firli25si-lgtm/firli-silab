@extends('layouts.mazer')

@section('title', 'Edit Jadwal Praktikum')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Jadwal Praktikum</h3>
                <p class="text-subtitle text-muted">Perbarui data: <strong>{{ $jadwal->mata_kuliah }}</strong></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jadwal-praktikum.index') }}">Jadwal Praktikum</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    <i class="bi bi-calendar-check me-2 text-warning"></i>Form Edit Jadwal
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jadwal-praktikum.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Laboratorium <span class="text-danger">*</span></label>
                            <select name="laboratorium_id" class="form-select @error('laboratorium_id') is-invalid @enderror" required>
                                <option value="">— Pilih Laboratorium —</option>
                                @foreach ($labs as $lab)
                                    <option value="{{ $lab->id }}"
                                        {{ old('laboratorium_id', $jadwal->laboratorium_id) == $lab->id ? 'selected' : '' }}>
                                        [{{ $lab->kode_lab }}] {{ $lab->nama_lab }}
                                    </option>
                                @endforeach
                            </select>
                            @error('laboratorium_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-semibold">Mata Kuliah <span class="text-danger">*</span></label>
                            <input type="text" name="mata_kuliah" class="form-control @error('mata_kuliah') is-invalid @enderror"
                                   value="{{ old('mata_kuliah', $jadwal->mata_kuliah) }}" required>
                            @error('mata_kuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Hari <span class="text-danger">*</span></label>
                            <select name="hari" class="form-select @error('hari') is-invalid @enderror" required>
                                @foreach ($hariList as $hari)
                                    <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                @endforeach
                            </select>
                            @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Dosen Pengampu <span class="text-danger">*</span></label>
                            <input type="text" name="dosen_pengampu" class="form-control @error('dosen_pengampu') is-invalid @enderror"
                                   value="{{ old('dosen_pengampu', $jadwal->dosen_pengampu) }}" required>
                            @error('dosen_pengampu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Jam Mulai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror"
                                   value="{{ old('jam_mulai', substr($jadwal->jam_mulai, 0, 5)) }}" required>
                            @error('jam_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Jam Selesai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror"
                                   value="{{ old('jam_selesai', substr($jadwal->jam_selesai, 0, 5)) }}" required>
                            @error('jam_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Kapasitas Peserta <span class="text-danger">*</span></label>
                            <input type="number" name="kapasitas_peserta" class="form-control @error('kapasitas_peserta') is-invalid @enderror"
                                   value="{{ old('kapasitas_peserta', $jadwal->kapasitas_peserta) }}" min="1" required>
                            @error('kapasitas_peserta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                      rows="2">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                            @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save me-1"></i>Perbarui
                        </button>
                        <a href="{{ route('jadwal-praktikum.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
