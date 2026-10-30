<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SiLab</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo mb-4">
                        <a href="{{ route('home') }}">
                            <h2 class="fw-bold" style="color: #435ebe;">Si<span style="color: #25a072;">Lab</span></h2>
                        </a>
                    </div>
                    <h1 class="auth-title">Daftar Akun</h1>
                    <p class="auth-subtitle mb-4">Daftarkan akun Anda untuk mengakses layanan SiLab.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-4">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-xl" placeholder="Nama Lengkap" required autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-xl" placeholder="Email Kampus" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password_confirmation" class="form-control form-control-xl" placeholder="Konfirmasi Password" required autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Daftar Sekarang</button>
                    </form>
                    <div class="text-center mt-4 text-lg fs-5">
                        <p class="text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-primary">Log in</a>.</p>
                        <p><a class="font-bold text-muted small" href="{{ route('home') }}">← Kembali ke Beranda SiLab</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
