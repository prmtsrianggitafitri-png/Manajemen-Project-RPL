<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prestasi - SIPRESMA</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; min-height: 100vh; background: linear-gradient(160deg, #a8cfe8 0%, #c8dff7 35%, #e8f2fb 65%, #ffffff 100%); }
        .section { display: flex; justify-content: center; padding: 3rem 1rem 5rem; }
        .card { background: rgba(255, 255, 255, 0.92); border: 1px solid rgba(200, 215, 235, 0.8); border-radius: 16px; padding: 2.25rem 2rem; width: 100%; max-width: 500px; backdrop-filter: blur(8px); }
        .card-header { display: flex; flex-direction: column; align-items: center; margin-bottom: 1.75rem; }
        .card-logo { height: 100px; width: auto; margin-bottom: 1rem; }
        .card-title { font-size: 24px; font-weight: 700; color: #1a3a5c; margin-bottom: 6px; text-align: center; }
        .form-rows { display: flex; flex-direction: column; gap: 12px; }
        .input-wrapper { display: flex; flex-direction: column; gap: 4px; }
        label.field-label { font-size: 12px; font-weight: 600; color: #555; }
        input[type="text"], select, textarea { width: 100%; padding: 0 14px; font-size: 14px; color: #111; background: #fff; border: 1px solid #dce6f0; border-radius: 8px; outline: none; transition: border-color 0.15s; }
        input[type="text"], select { height: 42px; }
        textarea { padding: 10px 14px; min-height: 90px; resize: vertical; }
        input[type="file"] { padding: 8px 14px; cursor: pointer; border: 1px solid #dce6f0; border-radius: 8px; font-size: 13px; }
        .btn-primary { width: 100%; height: 42px; font-size: 14px; font-weight: 600; border-radius: 8px; cursor: pointer; border: none; background: #c8dff7; color: #1a3a5c; margin-top: 10px; transition: 0.15s; }
        .btn-primary:hover { background: #aecfed; }
        .hint-file { font-size: 11px; color: #2980b9; margin-bottom: 4px; font-style: italic; }
        .error-message { font-size: 12px; color: #e24b4a; }
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
        .modal-box { background: white; padding: 2rem; border-radius: 15px; width: 90%; max-width: 400px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .modal-icon { width: 60px; height: 60px; border: 3px solid #f8bb86; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: #f8bb86; font-size: 30px; font-weight: bold; }
        .btn-modal { padding: 10px 20px; border-radius: 8px; cursor: pointer; border: none; font-weight: 600; }
        .btn-confirm { background: #d63384; color: white; }
        .btn-cancel { background: #94a3b8; color: white; }
    </style>
</head>
<body>

<section class="section">
    <div class="card">
        <div class="card-header">
            <img src="/logo-sipresma.png" alt="SIPRESMA" class="card-logo">
            <p class="card-title">Edit Data Prestasi</p>
        </div>

        <form id="editForm" action="{{ route('prestasi.update', $prestasi->id_prestasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            
            <div class="form-rows">
                <div class="input-wrapper">
                    <label class="field-label">Judul Prestasi</label>
                    <input type="text" name="judul" value="{{ old('judul', $prestasi->judul) }}" required>
                    @error('judul') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="input-wrapper">
                    <label class="field-label">Bidang</label>
                    <select name="bidang" required>
                        <option value="akademik" {{ old('bidang', $prestasi->bidang) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="non-akademik" {{ old('bidang', $prestasi->bidang) == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <label class="field-label">Kategori & Peringkat</label>
                    <select name="id_kategori" required>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id_kategori }}" {{ old('id_kategori', $prestasi->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }} - {{ $k->peringkat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-wrapper">
                    <label class="field-label">Deskripsi</label>
                    <textarea name="deskripsi" required>{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                </div>

                <div class="input-wrapper">
                    <label class="field-label">Ganti Bukti Prestasi</label>
                    @if($prestasi->bukti_prestasi)
                        <p class="hint-file">File saat ini: {{ basename($prestasi->bukti_prestasi) }}</p>
                    @endif
                    <input type="file" name="bukti_prestasi" accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <div class="input-wrapper">
                    <label class="field-label">Ganti Dokumentasi Pribadi</label>
                    @if($prestasi->dokumentasi_pribadi)
                        <p class="hint-file">File saat ini: {{ basename($prestasi->dokumentasi_pribadi) }}</p>
                    @endif
                    <input type="file" name="dokumentasi_pribadi" accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <button type="button" class="btn-primary" onclick="showConfirmModal()">Simpan Perubahan</button>
                <a href="{{ url('/tabelPrestasi') }}" style="text-align: center; display: block; font-size: 13px; color: #666; text-decoration: none; margin-top: 10px;">Batal</a>
            </div>
        </form>
    </div>
</section>

<div class="modal-overlay" id="confirmModal">
    <div class="modal-box">
        <div class="modal-icon">!</div>
        <h3 style="margin-bottom: 10px; color: #333;">Simpan Perubahan?</h3>
        <p style="font-size: 14px; color: #777; margin-bottom: 20px;">Pastikan data sudah benar. Status akan kembali menjadi "menunggu" untuk divalidasi ulang.</p>
        <div style="display: flex; gap: 10px; justify-content: center;">
            <button class="btn-modal btn-cancel" onclick="hideModal()">Batal</button>
            <button class="btn-modal btn-confirm" onclick="submitForm()">Ya, Simpan!</button>
        </div>
    </div>
</div>

<script>
    function showConfirmModal() {
        document.getElementById('confirmModal').style.display = 'flex';
    }
    function hideModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }
    function submitForm() {
        document.getElementById('editForm').submit();
    }
</script>

</body>
</html>