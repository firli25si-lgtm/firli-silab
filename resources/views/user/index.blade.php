@extends('layouts.master')

@section('title', 'Data User')

@section('content')
<div class="page-heading">
    <div class="page-title mb-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data User</h3>
                <p class="text-subtitle text-muted">Daftar pengguna terdaftar di sistem SiLab</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Tabel Pengguna</h4>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah User Baru
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA LENGKAP</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>TANGGAL DAFTAR</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $u)
                                <tr>
                                    <td class="text-bold-500">{{ $users->firstItem() + $index }}</td>
                                    <td class="fw-bold">{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                        @if ($u->role === 'admin' || $u->is_admin)
                                            <span class="badge bg-primary">Admin</span>
                                        @else
                                            <span class="badge bg-secondary">Mahasiswa</span>
                                        @endif
                                    </td>
                                    <td>{{ $u->created_at ? $u->created_at->format('d M Y H:i') : '-' }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <form action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada data user.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
