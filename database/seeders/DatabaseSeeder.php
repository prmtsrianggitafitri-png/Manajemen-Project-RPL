<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sipresma.com'],
            [
                'nama' => 'Admin Utama Sipresma',
                'username' => 'admin_sipresma',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_verified' => true,
                'npsn' => '12345678',
            ]
        );

        User::updateOrCreate(
            ['email' => 'maulana@student.ac.id'],
            [
                'nama' => 'Muhamad Maulana',
                'username' => 'maulana_psti',
                'password' => Hash::make('password123'),
                'nim' => '220102030',
                'jenis_kelamin' => 'laki-laki',
                'no_telepon' => '081234567890',
                'tahun_masuk' => 2022,
                'status_mahasiswa' => 'aktif',
                'role' => 'mahasiswa',
                'is_verified' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'anggita@student.ac.id'],
            [
                'nama' => 'Pramesti Anggita Fitri',
                'username' => 'anggita_png',
                'password' => Hash::make('password123'),
                'nim' => '220102031',
                'jenis_kelamin' => 'perempuan',
                'no_telepon' => '089876543210',
                'tahun_masuk' => 2022,
                'status_mahasiswa' => 'aktif',
                'role' => 'mahasiswa',
                'is_verified' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'alumni_psti@gmail.com'],
            [
                'nama' => 'Ega Bagus Pratama',
                'username' => 'ega_alumni',
                'password' => Hash::make('password123'),
                'nim' => '200102005',
                'jenis_kelamin' => 'laki-laki',
                'no_telepon' => '085522334455',
                'tahun_masuk' => 2020,
                'status_mahasiswa' => 'alumni',
                'role' => 'mahasiswa',
                'is_verified' => true,
            ]
        );
    }
}