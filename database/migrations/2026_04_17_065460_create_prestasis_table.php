<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id('id_prestasi');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nim');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('bidang');
            $table->string('status')->default('menunggu');
            $table->string('peringkat')->nullable();
            $table->integer('jumlah_poin')->default(0); 
            $table->string('bukti_prestasi')->nullable();
            $table->string('dokumentasi_pribadi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};