<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSidangPenguji extends Model
{
    protected $table = 'nilai_sidang_penguji';
    protected $fillable = [
        'p1',
        'p2',
        'p3',
        'kt1',
        'kt2',
        'kt3',
        'ml1',
        'ml2',
        'ml3',
        'ml4',
        'h1',
        'h2',
        'h3',
        'h4',
        'wbi',
        'kp',
        'tepatJ',
        'lancarJ',
        'nilai_akhir_sidang',
        'catatan_revisi',
    ];

    public function jadwalSidang(){
        // return $this->belongsToMany(JadwalSidang::class, 'id_jadwal', 'id_jadwal');
        return $this->hasMany(JadwalSidang::class);
    }
}
