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
        Schema::create('requestletters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained(
                table: 'kelas', indexName: 'reqletter_kelas_id')->onDelete('cascade');
            $table->foreignId('mahasiswa_id')->constrained(
                table: 'mahasiswas', indexName:'reqletter_mahasiswa_id')->onDelete('cascade');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requestletters');
    }
};
