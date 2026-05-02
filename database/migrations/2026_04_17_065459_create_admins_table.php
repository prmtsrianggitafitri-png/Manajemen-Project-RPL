public function up()
{
    Schema::create('admins', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('npsn')->unique();
        $table->string('password');
        $table->timestamps();
    });
}