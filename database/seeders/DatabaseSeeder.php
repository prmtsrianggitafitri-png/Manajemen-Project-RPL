<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        User::create([
            'nama' => 'Admin SIPRESMA',
            'email' => 'admin@test.com',
            'username' => 'admin123',
            'password' => Hash::make('password123'), 
            'role' => 'admin',
            'npsn' => '12345678',
            'no_telepon' => '081234567890',
            'jenis_kelamin' => 'laki-laki', 
            'is_verified' => true,
        ]);

        
        User::create([
            'nama' => 'Anggita Fitri Permatasaro',
            'email' => 'gtafp@test.com',
            'username' => 'gtafp',
            'nim' => '2405201',
            'password' => Hash::make('password123'), 
            'role' => 'mahasiswa',
            'jenis_kelamin' => 'perempuan',
            'no_telepon' => '089876543210',
            'tahun_masuk' => 2024,
            'status_mahasiswa' => 'aktif',
            'is_verified' => true,
        ]);
    }
}