<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSidangPembimbing extends Model
{
    protected $table = 'nilai_sidang_pembimbing';

    protected $fillable = [
        'id_jadwal',
        'nama_dosen',
        'nama_mahasiswa',
        'tanggal_sidang',
        'waktu_sidang',
        'nilai_tata_tulis',
        'nilai_keaktifan',
        'nilai_penguasaan_materi',
        'nilai_penyelesaian_masalah',
        'nilai_akhir_sidang',
        'catatan_revisi',
    ];

    public function jadwalSidang(){
        // return $this->hasMany(JadwalSidang::class, 'id_jadwal', 'id_jadwal');
        return $this->hasMany(JadwalSidang::class);
    }
}
