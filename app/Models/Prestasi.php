<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';
    protected $primaryKey = 'id_prestasi';

    protected $fillable = [
        'user_id', 
        'nama_prestasi',
        'skala',
        'tahun_perolehan',
        'file_sertifikat',
        'status_verifikasi',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}