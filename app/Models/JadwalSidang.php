<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalSidang extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sidang';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'tanggal_sidang',
        'waktu_sidang',
        'nidn_pembimbing',
        'nidn_penguji1',
        'nidn_penguji2',
        'nidn_penguji3',
        'nilai_pembimbing',
        'nilai_penguji1',
        'nilai_penguji2',
        'nilai_penguji3',
        'catatan_revisi',
        'nilai_akhir',
        'status_sidang',
    ];

    public function nilaiSidangPembimbing(){
        return $this->belongsTo(NilaiSidangPembimbing::class, 'id_jadwal', 'id_jadwal');
        // return $this->belongsTo(NilaiSidangPembimbing::class);
    }
    public function nilaiSidangPenguji(){
        return $this->belongsTo(NilaiSidangPenguji::class, 'id_jadwal', 'id_jadwal');
        // return $this->belongsTo(NilaiSidangPenguji::class);
    }
}
