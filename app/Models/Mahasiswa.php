<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'mahasiswas'; // Sesuaikan dengan nama di database kamu
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'jenis_kelamin',
        'tahun_masuk',
        'no_telepon',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // INI DIA TAMBAHANNYA:
    public function username()
    {
        return 'nim';
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}