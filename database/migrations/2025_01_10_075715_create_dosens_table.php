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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nidn')->unique();
            $table->string('nama_dosen');
            $table->integer('tahun_mulai_mengajar');
            $table->string('email')->unique();
            $table->string('nomor_telepon');
            $table->text('alamat');
            $table->string('jabatan_fungsional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
        Schema::dropIfExists('dosen');
    }
};
