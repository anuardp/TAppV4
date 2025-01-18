<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'nidn',
        'nama_dosen',
        'tahun_mulai_mengajar',
        'email',
        'nomor_telepon',
        'alamat',
        'jabatan_fungsional'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'username', 'nidn');
    }

    
}
