<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_prestasi', 
        'user_id', 
        'ip_address'
    ];

    // Relasi ke prestasi
    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class, 'id_prestasi');
    }
}