<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_prestasi', 
        'nim', 
        'ip_address'
    ];

    // Relasi ke prestasi
    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class, 'id_prestasi');
    }
}