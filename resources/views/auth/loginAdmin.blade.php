<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SIPRESMA</title>
    
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section {
            width: 100%;
            padding: 3rem 1rem 5rem;
            display: flex;
            justify-content: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(200, 215, 235, 0.8);
            border-radius: 16px;
            padding: 2.25rem 2rem;
            width: 100%;
            max-width: 420px;
            backdrop-filter: blur(8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .card-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .card-logo {
            height: 350px;
            width: auto;
            margin-bottom: 0rem;
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a3a5c;
            margin-bottom: 6px;
            text-align: center;
            margin-top: -80px;
        }

        .form-rows {
            display: flex;
            flex-direction: column;
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
        input[type="password"] {
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
        }

        input:hover { border-color: #b0c4d8; }
        input:focus {
            border-color: #7aa8d2;
            box-shadow: 0 0 0 3px rgba(122, 168, 210, 0.15);
        }
        input.is-invalid { border-color: #e24b4a; }

        .btn-primary {
            width: 100%;
            height: 42px;
            padding: 0 16px;
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

        input::placeholder { color: #aab4c0; }

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
                <h1 class="card-title">Login Admin</h1>
            </div>

            <form id="loginForm" method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-rows">

                    {{-- NPSN --}}
                    <div class="input-wrapper">
                        <label class="field-label">NPSN</label>
                        <input type="text" name="npsn" placeholder="Masukkan NPSN" value="{{ old('npsn') }}" class="{{ $errors->has('npsn') ? 'is-invalid' : '' }}" required autofocus />
                    </div>

                    {{-- Password --}}
                    <div class="input-wrapper">
                        <label class="field-label">Password</label>
                        <input type="password" name="password" placeholder="Masukkan Password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required />
                    </div>

                    <button type="submit" class="btn-primary">Masuk</button>
                </div>
            </form>
        </div>
    </section>

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

        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showModal('✅', 'Berhasil!', '{{ session("success") }}');
            @endif

            @if($errors->any())
                showModal('❌', 'Akses Ditolak', '{{ $errors->first() }}');
            @endif
        });
    </script>
</body>
</html>