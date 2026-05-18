<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Kategori.php

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';

    // Pastikan jumlah_poin ada di sini!
    protected $fillable = [
        'nama_kategori', 
        'peringkat', 
        'jumlah_poin'
    ];
}