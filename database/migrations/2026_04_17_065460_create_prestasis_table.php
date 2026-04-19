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
            $table->foreignId('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
            $table->foreignId('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->enum('bidang', ['akademik', 'non-akademik']);
            $table->enum('status', ['disetujui', 'menunggu']);
            $table->integer('poin');
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
