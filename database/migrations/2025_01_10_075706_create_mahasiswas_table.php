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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->string('nim')->unique();
            $table->string('nama_mahasiswa');
            $table->integer('angkatan');
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('judul')->nullable();
            $table->string('email')->unique();
            $table->string('nomor_telepon');
            $table->text('alamat');
            $table->text('catatan_revisi')->nullable();
            $table->enum('status_sidang', ['sudah', 'belum'])->default('belum');
            $table->enum('status_revisi_laporan', ['sudah', 'belum']);
            $table->float('indeks_akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
        Schema::dropIfExists('mahasiswa');
    }
};
