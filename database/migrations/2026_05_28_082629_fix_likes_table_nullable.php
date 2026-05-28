<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixLikesTableNullable extends Migration
{
    public function up(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            // Jadikan user_id nullable (untuk guest yang like via IP)
            $table->unsignedBigInteger('user_id')->nullable()->change();
            
            // Tambah ip_address jika belum ada
            if (!Schema::hasColumn('likes', 'ip_address')) {
                $table->string('ip_address')->nullable()->after('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
}