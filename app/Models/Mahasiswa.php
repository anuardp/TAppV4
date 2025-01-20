<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'angkatan',
        'fakultas',
        'prodi',
        'judul',
        'email',
        'nomor_telepon',
        'alamat'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'username', 'nim');
    }
    

    public function jadwalSidang()
    {
        return $this->hasOne(JadwalSidang::class, 'nim', 'nim');
    }
    

}
