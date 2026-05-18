<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';
    protected $primaryKey = 'id_prestasi';

    protected $fillable = [
        'id_kategori',
        'nim',
        'judul',
        'bidang',
        'deskripsi',
        'status',
        'peringkat',
        'jumlah_poin',
        'bukti_prestasi',
        'dokumentasi_pribadi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'nim');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}