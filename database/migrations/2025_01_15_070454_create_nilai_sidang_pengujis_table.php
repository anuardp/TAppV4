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
        Schema::create('nilai_sidang_penguji', function (Blueprint $table) {
            // $table->id_penguji();
            // $table->foreignId('id_jadwal')->constrained('jadwal_sidang')->onDelete('cascade');
            // $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwalSidang');
            $table->id('id_penguji');
            $table->unsignedBigInteger('id_jadwal');
            // $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwalSidang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal_sidang')->onDelete('cascade')->onUpdate('cascade');

            $table->string('nama_dosen');
            $table->string('nama_mahasiswa');
            $table->date('tanggal_sidang');
            $table->time('waktu_sidang');
            $table->enum('status_penilai', ['penguji1', 'penguji2', 'penguji3']);
            $table->float('p1')->nullable();
            $table->float('p2')->nullable();
            $table->float('p3')->nullable();
            $table->float('kt1')->nullable();
            $table->float('kt2')->nullable();
            $table->float('kt3')->nullable();
            $table->float('ml1')->nullable();
            $table->float('ml2')->nullable();
            $table->float('ml3')->nullable();
            $table->float('ml4')->nullable();
            $table->float('h1')->nullable();
            $table->float('h2')->nullable();
            $table->float('h3')->nullable();
            $table->float('h4')->nullable();
            $table->float('wbi')->nullable();
            $table->float('kp')->nullable();
            $table->boolean('tepatJ')->nullable();
            $table->boolean('lancarJ')->nullable();
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
        Schema::dropIfExists('nilai_sidang_penguji');
    }
};
