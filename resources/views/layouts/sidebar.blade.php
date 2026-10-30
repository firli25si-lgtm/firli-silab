<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ route('dashboard') }}" class="fs-4 fw-bold" style="text-decoration: none;">
                    <i class="bi bi-cpu-fill text-primary"></i> SiLab Admin
                </a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu Utama</li>

            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('alat.*') || request()->is('data-barang*') ? 'active' : '' }}">
                <a href="{{ route('alat.index') }}" class="sidebar-link">
                    <i class="bi bi-tools"></i>
                    <span>Data Alat Lab</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Data User</span>
                </a>
            </li>

            <li class="sidebar-title">Transaksi & Lainnya</li>

            <li class="sidebar-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                <a href="{{ route('peminjaman.index') }}" class="sidebar-link">
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Peminjaman Alat</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                <a href="{{ route('kategori.index') }}" class="sidebar-link">
                    <i class="bi bi-tags-fill"></i>
                    <span>Kategori Alat</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('/') }}" class="sidebar-link" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>Halaman Tamu (Guest)</span>
                </a>
            </li>

            <li class="sidebar-title">Akun</li>

            <li class="sidebar-item">
                <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="sidebar-link text-danger">
                        <i class="bi bi-box-arrow-right text-danger"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
