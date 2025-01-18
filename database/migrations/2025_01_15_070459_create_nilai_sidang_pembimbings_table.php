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
        Schema::create('nilai_sidang_pembimbing', function (Blueprint $table) {
            // $table->id_pembimbing();
            // $table->foreignId('id_jadwal')->constrained('jadwal_sidang')->onDelete('cascade');
            
            $table->id('id_pembimbing');
            $table->unsignedBigInteger('id_jadwal');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal_sidang')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_dosen');
            $table->string('nama_mahasiswa');
            $table->date('tanggal_sidang');
            $table->time('waktu_sidang');
            $table->float('nilai_tata_tulis')->nullable();
            $table->float('nilai_keaktifan')->nullable();
            $table->float('nilai_penguasaan_materi')->nullable();
            $table->float('nilai_penyelesaian_masalah')->nullable();
            $table->float('nilai_akhir_sidang')->nullable();
            $table->text('catatan_revisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sidang_pembimbing');
    }
};
