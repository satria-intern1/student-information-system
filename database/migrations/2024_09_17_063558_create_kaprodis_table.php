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
        Schema::create('kaprodis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table:'users', indexName:'kaprodi_user_id')->onDelete('cascade');

            //kode dosen maybe refer to NIDN
            //if NIDN start with 0, change to string unique
            $table->bigInteger('kode_dosen')->unique();
            $table->bigInteger('nip')->unique();

            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaprodis');
    }
};
