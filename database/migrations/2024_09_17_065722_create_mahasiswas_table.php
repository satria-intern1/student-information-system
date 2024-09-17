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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table:'users', indexName:'mahasiswa_user_id')->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained(
                table: 'kelas', indexName: 'mahasiswa_kelas_id');

            //kode dosen maybe refer to NIDN
            //if NIDN start with 0, change to string unique
            $table->bigInteger('nim')->unique();

            $table->string('name');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            $table->boolean('edit')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
