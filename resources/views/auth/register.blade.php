<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIPRESMA</title>
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            background: linear-gradient(160deg, #a8cfe8 0%, #c8dff7 35%, #e8f2fb 65%, #ffffff 100%);
        }

        .section {
            display: flex;
            justify-content: center;
            padding: 3rem 1rem 5rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(200, 215, 235, 0.8);
            border-radius: 16px;
            padding: 2.25rem 2rem;
            width: 100%;
            max-width: 420px;
            backdrop-filter: blur(8px);
        }

        .card-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1.75rem;
        }

        .card-logo {
            height: 350px;
            width: auto;
            margin-bottom: 0rem;
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
            text-align: center;
            margin-top: -80px;
        }

        .card-subtitle {
            font-size: 14px;
            color: #888;
            text-align: center;
        }

        .form-rows {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .form-row-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .input-wrapper {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        label.field-label {
            font-size: 12px;
            font-weight: 500;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            height: 42px;
            padding: 0 14px;
            font-size: 14px;
            color: #111;
            background: #fff;
            border: 1px solid #dce6f0;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            appearance: none;
            -webkit-appearance: none;
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23888' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
            cursor: pointer;
        }

        input::placeholder { color: #aab4c0; }
        input:hover, select:hover { border-color: #b0c4d8; }
        input:focus, select:focus {
            border-color: #7aa8d2;
            box-shadow: 0 0 0 3px rgba(122, 168, 210, 0.15);
        }
        input.is-invalid, select.is-invalid { border-color: #e24b4a; }

        .hint { font-size: 12px; color: #9aacbb; }
        .error-message { font-size: 12px; color: #e24b4a; }

        .alert-success {
            background: #eaf6ee;
            border: 1px solid #a8d5b5;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #2d6a4f;
            margin-bottom: 16px;
        }

        .btn-primary {
            width: 100%;
            height: 42px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            border: none;
            background: #c8dff7;
            color: #1a3a5c;
            margin-top: 4px;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-primary:hover { background: #aecfed; }
        .btn-primary:active { transform: scale(0.98); }

        .footer-text {
            display: flex;
            justify-content: center;
            gap: 4px;
            font-size: 13px;
            color: #9aacbb;
            margin-top: 1.75rem;
        }

        .footer-text a {
            color: #7aa8d2;
            font-weight: 500;
            text-decoration: none;
        }

        .footer-text a:hover { text-decoration: underline; }

        /* === POPUP MODAL === */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.35);
    z-index: 999;
    align-items: center;
    justify-content: center;
}
.modal-overlay.active { display: flex; }

.modal-box {
    background: #fff;
    border-radius: 12px;
    padding: 1.75rem 1.5rem;
    width: 90%;
    max-width: 320px;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}
.modal-icon {
    font-size: 2.5rem;
    margin-bottom: 0.75rem;
}
.modal-title {
    font-size: 16px;
    font-weight: 700;
    color: #111;
    margin-bottom: 6px;
}
.modal-message {
    font-size: 13px;
    color: #666;
    margin-bottom: 1.25rem;
    line-height: 1.5;
}
.modal-btn {
    display: inline-block;
    padding: 8px 28px;
    background: #c8dff7;
    color: #1a3a5c;
    font-size: 14px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.15s;
}
.modal-btn:hover { background: #aecfed; }
    </style>
</head>
<body>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <img src="/logo-sipresma.png" alt="SIPRESMA" class="card-logo">
                <p class="card-title">Regristrasi Akun Sipresma</p>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-rows">

                    <div class="input-wrapper">
                        <label class="field-label">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap"
                            value="{{ old('nama') }}"
                            class="{{ $errors->has('nama') ? 'is-invalid' : '' }}" required />
                        @error('nama') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-wrapper">
                        <label class="field-label">Email</label>
                        <input type="email" name="email" placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required />
                        @error('email') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-wrapper">
                        <label class="field-label">NIM</label>
                        <input type="text" name="nim" placeholder="Masukkan NIM"
                            value="{{ old('nim') }}"
                            class="{{ $errors->has('nim') ? 'is-invalid' : '' }}" required />
                        @error('nim') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-row-2col">
                        <div class="input-wrapper">
                            <label class="field-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="{{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" required>
                                <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih</option>
                                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="input-wrapper">
                            <label class="field-label">Tahun Masuk</label>
                            <input type="number" name="tahun_masuk" placeholder="Contoh: 2022"
                                value="{{ old('tahun_masuk') }}"
                                min="2000" max="{{ date('Y') }}"
                                class="{{ $errors->has('tahun_masuk') ? 'is-invalid' : '' }}" required />
                            @error('tahun_masuk') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="input-wrapper">
                        <label class="field-label">No. Telepon</label>
                        <input type="tel" name="no_telepon" placeholder="Contoh: 08123456789"
                            value="{{ old('no_telepon') }}"
                            class="{{ $errors->has('no_telepon') ? 'is-invalid' : '' }}" required />
                        @error('no_telepon') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-wrapper">
                        <label class="field-label">Password</label>
                        <input type="password" name="password" placeholder="Masukkan password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required />
                        <p class="hint">Minimal 8 karakter.</p>
                        @error('password') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-wrapper">
                        <label class="field-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required />
                    </div>

                    <button type="submit" class="btn-primary">Buat Akun</button>

                </div>

                <div class="footer-text">
                    <p>Sudah punya akun?</p>
                    <a href="{{ route('login') }}">Masuk</a>
                </div>
            </form>
        </div>
    </section>

    <!-- Modal Popup -->
<div class="modal-overlay" id="modalOverlay">
    <div class="modal-box">
        <div class="modal-icon" id="modalIcon"></div>
        <p class="modal-title" id="modalTitle"></p>
        <p class="modal-message" id="modalMessage"></p>
        <button class="modal-btn" onclick="closeModal()">OK</button>
    </div>
</div>

<script>
    function showModal(icon, title, message) {
        document.getElementById('modalIcon').textContent = icon;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').textContent = message;
        document.getElementById('modalOverlay').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('active');
    }

    /* Cek apakah ada session success dari Laravel — tampilkan popup */
    @if(session('success'))
        window.addEventListener('DOMContentLoaded', function() {
            showModal('✅', 'Registrasi Berhasil!', 'Akun kamu berhasil dibuat. Silakan masuk.');
        });
    @endif

    const form = document.querySelector('form');
    const password = document.querySelector('input[name="password"]');
    const confirm = document.querySelector('input[name="password_confirmation"]');

    form.addEventListener('submit', function(e) {
        if (password.value.length < 8) {
            e.preventDefault();
            showModal('⚠️', 'Password Terlalu Pendek', 'Password harus minimal 8 karakter.');
        } else if (password.value !== confirm.value) {
            e.preventDefault();
            showModal('❌', 'Password Tidak Sama', 'Password dan konfirmasi password tidak cocok.');
        }
    });
</script>

</body>
</html>
