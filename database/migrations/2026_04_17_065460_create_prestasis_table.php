public function up(): void
{
    Schema::table('prestasis', function (Blueprint $table) {
        $table->string('bukti_prestasi')->nullable()->after('poin');
        $table->string('dokumentasi_pribadi')->nullable()->after('bukti_prestasi');
    });
}

public function down(): void
{
    Schema::table('prestasis', function (Blueprint $table) {
        $table->dropColumn(['bukti_prestasi', 'dokumentasi_pribadi']);
    });
}