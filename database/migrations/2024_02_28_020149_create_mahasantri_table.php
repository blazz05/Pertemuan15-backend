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
        Schema::create('mahasantri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mhs');
            $table->string('alamat_mhs');
            $table->integer('umur_mhs');
            $table->integer('id_jrs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasantri');
    }
};
