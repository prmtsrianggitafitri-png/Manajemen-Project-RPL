<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - SIPRESMA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="login-page-wrapper">
        <div class="login-card">
            <div class="logo-container">
                <img src="{{ asset('storage/sipresma.png') }}" alt="SIPRESMA Logo" width="120">
            </div>

            <h1 class="title-text">Login Mahasiswa</h1>
            <p class="subtitle-text">Masuk menggunakan NIM dan password terdaftar.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf <div class="input-group">
                    <label for="nim" class="input-label">NIM</label>
                    <input type="text" name="nim" id="nim" placeholder="Masukkan NIM" value="{{ old('nim') }}" required autofocus>
                    @error('nim')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password" class="input-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    Masuk ke Dashboard
                </button>
            </form>

            <div class="footer-link">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</body>
</html>