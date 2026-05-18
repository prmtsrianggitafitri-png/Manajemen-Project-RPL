<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $data = [
        [
            'nama_kategori' => 'Peringkat 1',
            'peringkat' => 'Nasional',
            'jumlah_poin' => 100,
        ],
        [
            'nama_kategori' => 'Peringkat 2',
            'peringkat' => 'Provinsi',
            'jumlah_poin' => 75,
        ],
        [
            'nama_kategori' => 'Peringkat 3',
            'peringkat' => 'Universitas',
            'jumlah_poin' => 50,
        ],
    ];

    foreach ($data as $val) {
        \App\Models\Kategori::create($val);
    }
}
}
