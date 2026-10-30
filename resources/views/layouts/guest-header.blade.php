<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h1 class="m-0 text-primary"><i class="fa fa-flask me-2"></i>SiLab <span class="text-secondary fs-4">Guest</span></h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/about') }}" class="nav-item nav-link {{ request()->is('about*') ? 'active' : '' }}">Tentang</a>
            <a href="{{ url('/service') }}" class="nav-item nav-link {{ request()->is('service*') ? 'active' : '' }}">Katalog Alat</a>
            <a href="{{ url('/project') }}" class="nav-item nav-link {{ request()->is('project*') ? 'active' : '' }}">Laboratorium</a>
            <a href="{{ url('/contact') }}" class="nav-item nav-link {{ request()->is('contact*') ? 'active' : '' }}">Kontak</a>
            @auth
                <a href="{{ route('dashboard') }}" class="nav-item nav-link text-primary fw-bold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-item nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                <a href="{{ route('register') }}" class="nav-item nav-link {{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
            @endauth
        </div>
    </div>
</nav>
