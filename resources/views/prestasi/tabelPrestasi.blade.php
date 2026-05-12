<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Prestasi - SIPRESMA</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            padding: 20px; 
            background-color: #f4f7f6; 
            margin: 0;
        }
        
        h2 { color: #333; margin-bottom: 20px; }

        /* Alert Sukses */
        .alert-success {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto; 
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            min-width: 1000px; 
        }

        th, td { 
            padding: 12px 15px; 
            border: 1px solid #eee; 
            text-align: left; 
            font-size: 14px;
        }

        th { 
            background-color: #c8dff7; 
            color: #1a3a5c; 
        }

        .img-preview {
            width: 80px; 
            height: 50px; 
            object-fit: cover; 
            border-radius: 4px;
        }

        .btn-edit { color: #f39c12; font-weight: bold; text-decoration: none; margin-right: 10px; }
        .btn-hapus { color: #e74c3c; background: none; border: none; cursor: pointer; font-weight: bold; }
        .status-tag { padding: 4px 8px; border-radius: 12px; font-size: 12px; background: #ffeaa7; color: #d35400; font-weight: bold; }

        /* ======================== 
           MODAL CUSTOM CSS 
           ======================== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2px);
        }

        .modal-box {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            border: 4px solid #f8bb86;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: #f8bb86;
            font-size: 40px;
            font-weight: bold;
        }

        .modal-title { font-size: 24px; font-weight: 700; color: #444; margin-bottom: 10px; }
        .modal-text { font-size: 16px; color: #777; margin-bottom: 25px; }

        .modal-footer { display: flex; gap: 10px; justify-content: center; }

        .btn-modal {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-size: 14px;
        }

        .btn-batal { background: #94a3b8; color: white; }
        .btn-konfirmasi { background: #d63384; color: white; } /* Warna Pink sesuai gambar lu Lan */
        
        .btn-modal:hover { opacity: 0.9; }
    </style>
</head>
<body>

    <h2>Halaman Monitoring Prestasi</h2>

    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Bidang</th>
                    <th>Kategori</th>
                    <th>Peringkat</th>
                    <th>Deskripsi</th>
                    <th>Poin</th>
                    <th>Bukti</th>
                    <th>Dokumentasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestasis as $p)
                <tr>
                    <td><strong>{{ $p->judul }}</strong></td>
                    <td>{{ $p->bidang }}</td>
                    <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $p->peringkat }}</td>
                    <td style="min-width: 200px;">{{ $p->deskripsi }}</td>
                    <td>{{ $p->jumlah_poin }}</td>
                    
                    <td>
                        @if($p->bukti_prestasi)
                            <img src="{{ asset('storage/' . $p->bukti_prestasi) }}" class="img-preview">
                        @else - @endif
                    </td>

                    <td>
                        @if($p->dokumentasi_pribadi)
                            <img src="{{ asset('storage/' . $p->dokumentasi_pribadi) }}" class="img-preview">
                        @else - @endif
                    </td>

                    <td><span class="status-tag">{{ $p->status }}</span></td>
                    
                    <td>
                        @if($p->status == 'menunggu' || $p->status == 'revisi')
                            <a href="{{ url('/prestasi/edit/'.$p->id_prestasi) }}" class="btn-edit">Edit</a>
                            
                            <button type="button" class="btn-hapus" onclick="confirmDelete('{{ $p->id_prestasi }}', '{{ $p->judul }}')">Hapus</button>

                            <form id="form-delete-{{ $p->id_prestasi }}" action="{{ url('/prestasi/delete/'.$p->id_prestasi) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @else
                            <span style="color: #27ae60; font-size: 12px; font-weight: bold;">✔ Terverifikasi</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal-overlay" id="modalDelete">
        <div class="modal-box">
            <div class="modal-icon">!</div>
            <div class="modal-title">Anda yakin akan menghapusnya?</div>
            <div class="modal-text" id="modalText">Prestasi ini akan hilang dari sistem!</div>
            <div class="modal-footer">
                <button class="btn-modal btn-batal" onclick="closeModal()">Batal</button>
                <button class="btn-modal btn-konfirmasi" id="btnConfirmDelete">Ya, Hapus!</button>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteId = null;

        function confirmDelete(id, judul) {
            currentDeleteId = id;
            document.getElementById('modalText').innerText = `Prestasi "${judul}" akan hilang dari sistem!`;
            document.getElementById('modalDelete').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modalDelete').style.display = 'none';
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (currentDeleteId) {
                document.getElementById('form-delete-' + currentDeleteId).submit();
            }
        });

        window.onclick = function(event) {
            let modal = document.getElementById('modalDelete');
            if (event.target == modal) {
                closeModal();
            }
        }

        setTimeout(function() {
            let alert = document.querySelector('.alert-success');
            if (alert) {
                alert.style.transition = "opacity 0.5s";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>

</body>
</html>