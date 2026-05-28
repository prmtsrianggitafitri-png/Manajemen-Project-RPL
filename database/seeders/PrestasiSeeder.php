<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;
use App\Models\Kategori;
use App\Models\User;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua ID kategori dan NIM mahasiswa yang ada di DB lu
        $kategoriIds = Kategori::pluck('id_kategori')->toArray();
        $mahasiswaNims = User::where('role', 'mahasiswa')->pluck('nim')->toArray();

        // Jaga-jaga kalau data kategori atau mahasiswa lu masih kosong melompong
        if (empty($kategoriIds) || empty($mahasiswaNims)) {
            $this->command->warn('Gagal Seeding: Pastikan tabel kategoris dan users (role mahasiswa) sudah ada isinya terlebih dahulu!');
            return;
        }

        // Daftar 10 data prestasi tiruan yang variatif
        $daftarPrestasi = [
            [
                'judul' => 'Juara 1 Lomba Karya Tulis Ilmiah Nasional (LKTIN)',
                'bidang' => 'akademik',
                'deskripsi' => 'Meraih medali emas dalam ajang LKTIN dengan inovasi platform pembelajaran adaptif berbasis kecerdasan buatan.',
            ],
            [
                'judul' => 'Juara 2 National Programming Contest',
                'bidang' => 'akademik',
                'deskripsi' => 'Berhasil menyelesaikan 8 dari 10 soal algoritma kompleks dalam waktu 3 jam di kompetisi coding nasional.',
            ],
            [
                'judul' => 'Medali Perunggu Olimpiade Matematika Mahasiswa',
                'bidang' => 'akademik',
                'deskripsi' => 'Kompetisi tingkat nasional yang diikuti oleh 150 universitas di bidang matematika diskrit dan kalkulus tingkat lanjut.',
            ],
            [
                'judul' => 'Juara 1 Turnamen Futsal Rektor Cup',
                'bidang' => 'non-akademik',
                'deskripsi' => 'Membawa tim jurusan meraih gelar juara umum setelah mengalahkan fakultas teknik di babak final.',
            ],
            [
                'judul' => 'Juara 3 Kompetisi Debat Bahasa Inggris (NUDC)',
                'bidang' => 'akademik',
                'deskripsi' => 'Meraih posisi ketiga dalam kompetisi debat parlemen tingkat wilayah setelah melewati 5 babak penyisihan.',
            ],
            [
                'judul' => 'Best Presenter pada International Conference on EdTech',
                'bidang' => 'akademik',
                'deskripsi' => 'Mempresentasikan paper riset mengenai Item Response Theory (IRT) di depan panelis internasional.',
            ],
            [
                'judul' => 'Juara 1 Lomba Desain UI/UX Tingkat Nasional',
                'bidang' => 'non-akademik',
                'deskripsi' => 'Merancang prototipe aplikasi mobile untuk efisiensi birokrasi kampus dengan skor kemudahan pengguna tertinggi.',
            ],
            [
                'judul' => 'Juara 2 Lomba Fotografi Dokumenter Sejarah',
                'bidang' => 'non-akademik',
                'deskripsi' => 'Mengangkat tema peninggalan budaya Nusantara lewat esai foto objek sejarah di Museum Nasional.',
            ],
            [
                'judul' => 'Harapan 1 Gemastik Bidang Karya Tulis Ilmiah TIK',
                'bidang' => 'akademik',
                'deskripsi' => 'Mengembangkan proposal sistem penjaminan mutu pendidikan terintegrasi berbasis big data.',
            ],
            [
                'judul' => 'Juara 3 Pencak Silat Antar Perguruan Tinggi',
                'bidang' => 'non-akademik',
                'deskripsi' => 'Meraih medali perunggu pada kategori tanding kelas B putra tingkat mahasiswa nasional.',
            ],
        ];

        foreach ($daftarPrestasi as $data) {
            // Pilih kategori & mahasiswa acak untuk setiap baris data
            $idKategoriAcak = $kategoriIds[array_rand($kategoriIds)];
            $nimAcak = $mahasiswaNims[array_rand($mahasiswaNims)];
            
            // Ambil detail kategori buat nyalin poin & peringkatnya sesuai cara kerja controller lu
            $kategori = Kategori::find($idKategoriAcak);

            Prestasi::create([
                'id_kategori' => $kategori->id_kategori,
                'nim' => $nimAcak,
                'judul' => $data['judul'],
                'bidang' => $data['bidang'],
                'deskripsi' => $data['deskripsi'],
                'status' => 'menunggu', // Status default sesuai controller
                'peringkat' => $kategori->peringkat ?? 'Juara 1',
                'jumlah_poin' => $kategori->jumlah_poin ?? 100,
                'bukti_prestasi' => 'prestasi/bukti/dummy_bukti.pdf', // Path file tiruan
                'dokumentasi_pribadi' => 'prestasi/dokumentasi/dummy_dok.jpg',
            ]);
        }
    }
}