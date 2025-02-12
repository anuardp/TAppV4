<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function home()
    {
        $nim = Auth::user()->username; // Ambil NIM mahasiswa yang login
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        $jadwalSidang = JadwalSidang::where('nim', $nim)->first();

        $pengumuman = '';

        if ($jadwalSidang->status_sidang === 'belum') {
            $pengumuman = 'Anda belum melaksanakan sidang tugas akhir.';
        } elseif ($jadwalSidang->status_sidang == 'sudah' && is_null($jadwalSidang->nilai_akhir)) {
            $pengumuman = 'Anda telah lulus sidang dengan catatan revisi.';
        } elseif (!is_null($jadwalSidang->indeks_akhir)) {
            $pengumuman = 'Selamat! Anda telah menyelesaikan tugas akhir dengan nilai: ' . $jadwalSidang->nilai_akhir;
        }

        return view('mahasiswa.dashboard', compact('pengumuman'));
    }
}
