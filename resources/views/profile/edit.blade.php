@extends('layouts.mazer')

@section('title', 'Profil Pengguna')

@section('heading')
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Profil Pengguna</h3>
            <p class="text-subtitle text-muted">Kelola informasi akun dan kata sandi Anda.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <!-- Informasi Akun -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi Profil</h5>
                    <p class="card-subtitle text-muted">Perbarui nama dan alamat email akun Anda.</p>
                </div>
                <div class="card-body">
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success alert-dismissible show fade">
                            Profil berhasil diperbarui.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Profil</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Ganti Password -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ganti Kata Sandi</h5>
                    <p class="card-subtitle text-muted">Pastikan akun Anda menggunakan kata sandi yang kuat.</p>
                </div>
                <div class="card-body">
                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success alert-dismissible show fade">
                            Kata sandi berhasil diperbarui.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror">
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Kata Sandi Baru</label>
                            <input type="password" id="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror">
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror">
                            @error('password_confirmation', 'updatePassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning"><i class="bi bi-key me-1"></i> Perbarui Kata Sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
