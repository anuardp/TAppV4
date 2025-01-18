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
        Schema::create('jadwal_sidang', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->string('nim');
            $table->string('nama_mahasiswa');
            $table->date('tanggal_sidang');
            $table->time('waktu_sidang');
            $table->string('nidn_pembimbing');
            $table->string('nidn_penguji1');
            $table->string('nidn_penguji2');
            $table->string('nidn_penguji3'); // sama dengan nidn_pembimbing
            $table->float('nilai_pembimbing')->nullable();
            $table->float('nilai_penguji1')->nullable();
            $table->float('nilai_penguji2')->nullable();
            $table->float('nilai_penguji3')->nullable();
            $table->text('catatan_revisi')->nullable();
            $table->float('nilai_akhir')->nullable();
            $table->enum('status_sidang', ['sudah', 'belum'])->default('belum');
            $table->enum('hasil_sidang', ['lulus', 'lulus dengan catatan', 'tidak lulus'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sidang');
    }
};
