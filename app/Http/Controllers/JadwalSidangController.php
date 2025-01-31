<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalSidangController extends Controller
{
    public function nilaiSidangPenguji()
    {
        return $this->hasMany(NilaiSidangPenguji::class, 'id_jadwal');
    }
    
    public function nilaiSidangPembimbing()
    {
        return $this->hasMany(NilaiSidangPembimbing::class, 'id_jadwal');
    }
}
