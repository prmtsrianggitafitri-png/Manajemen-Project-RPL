<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Prestasi - SIPRESMA</title>
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
            max-width: 500px;
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
        input[type="date"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
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

        input[type="text"],
        input[type="date"],
        select {
            height: 42px;
        }

        input[type="file"] {
            padding: 8px 14px;
            cursor: pointer;
        }

        textarea {
            padding: 10px 14px;
            min-height: 90px;
            resize: vertical;
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23888' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
            cursor: pointer;
        }

        input::placeholder, textarea::placeholder { color: #aab4c0; }
        input:hover, select:hover, textarea:hover { border-color: #b0c4d8; }
        input:focus, select:focus, textarea:focus {
            border-color: #7aa8d2;
            box-shadow: 0 0 0 3px rgba(122, 168, 210, 0.15);
        }
        input.is-invalid, select.is-invalid { border-color: #e24b4a; }

        .hint { font-size: 12px; color: #9aacbb; }
        .error-message { font-size: 12px; color: #e24b4a; }

        .file-alert {
            display: none;
            font-size: 12px;
            color: #e65100;
            background: #fff3e0;
            border: 1px solid #ffcc80;
            border-radius: 6px;
            padding: 6px 10px;
            margin-top: 2px;
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

        /* Modal */
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
        .modal-icon { font-size: 2.5rem; margin-bottom: 0.75rem; }
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
            <p class="card-title">Upload Prestasi Mahasiswa</p>
        </div>

        @if($errors->any())
            <div style="background:#fdecea;border:1px solid #f5c6cb;border-radius:8px;padding:10px 14px;margin-bottom:16px;font-size:13px;color:#c0392b;">
                <ul style="padding-left:16px">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data" id="formPrestasi">
            @csrf
            <div class="form-rows">

            <div class="input-wrapper">
                    <label class="field-label">Judul Prestasi</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Juara 1 Olimpiade Matematika" required>
                    @error('judul') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="input-wrapper">
                    <label class="field-label">Bidang</label>
                    <select name="bidang" required>
                        <option value="">-- Pilih Bidang --</option>
                        <option value="akademik" {{ old('bidang')=='akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="non-akademik" {{ old('bidang')=='non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                    </select>
                    @error('bidang') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="input-wrapper">
                    <label class="field-label">Pilih Kategori & Peringkat</label>
                    <select name="id_kategori" required>
                        <option value="">-- Pilih Kategori Prestasi --</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }} - {{ $k->peringkat }} ({{ $k->poin }} Poin)
                            </option>
                        @endforeach
                    </select>
                    <span class="hint">Contoh: Nasional - Juara 1</span>
                    @error('id_kategori') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                

                <div class="input-wrapper">
                    <label class="field-label">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Ceritakan prestasi kamu...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <span class="error-message">{{ $message }}</span> @enderror
                </div>


                <div class="input-wrapper">
                    <label class="field-label">Bukti Prestasi <span style="color:#e24b4a">*</span></label>
                    <input type="file" name="bukti_prestasi" id="bukti_prestasi" accept=".pdf,.jpg,.jpeg,.png" required onchange="checkFileSize(this, 'alert-bukti')">
                    <span class="hint">Format: PDF/JPG/PNG. Maks 500MB.</span>
                    <div class="file-alert" id="alert-bukti">⚠️ Ukuran file melebihi 500MB!</div>
                    @error('bukti_prestasi') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="input-wrapper">
                    <label class="field-label">Dokumentasi Pribadi <span style="color:#9aacbb">(Opsional)</span></label>
                    <input type="file" name="dokumentasi_pribadi" id="dokumentasi_pribadi" accept=".pdf,.jpg,.jpeg,.png" onchange="checkFileSize(this, 'alert-dok')">
                    <span class="hint">Format: PDF/JPG/PNG. Maks 500MB.</span>
                    <div class="file-alert" id="alert-dok">⚠️ Ukuran file melebihi 500MB!</div>
                    @error('dokumentasi_pribadi') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn-primary">Upload Prestasi</button>

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
    const MAX_SIZE = 500 * 1024 * 1024;

    function checkFileSize(input, alertId) {
        const alertEl = document.getElementById(alertId);
        if (input.files[0] && input.files[0].size > MAX_SIZE) {
            alertEl.style.display = 'block';
            input.value = '';
        } else {
            alertEl.style.display = 'none';
        }
    }

    function showModal(icon, title, message) {
        document.getElementById('modalIcon').textContent = icon;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').textContent = message;
        document.getElementById('modalOverlay').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('active');
    }

    @if(session('success'))
        window.addEventListener('DOMContentLoaded', function() {
            showModal('✅', 'Upload Berhasil!', 'Prestasi kamu berhasil diunggah dan sedang menunggu verifikasi.');
        });
    @endif

    document.getElementById('formPrestasi').addEventListener('submit', function(e) {
        const bukti = document.getElementById('bukti_prestasi');
        const dok = document.getElementById('dokumentasi_pribadi');
        if (bukti.files[0] && bukti.files[0].size > MAX_SIZE) {
            e.preventDefault();
            document.getElementById('alert-bukti').style.display = 'block';
        }
        if (dok.files[0] && dok.files[0].size > MAX_SIZE) {
            e.preventDefault();
            document.getElementById('alert-dok').style.display = 'block';
        }
    });
</script>

</body>
</html>