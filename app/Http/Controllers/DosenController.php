<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function cekJadwalSidang()
    {
        // $dosenNidn = Auth::user()->username;

        $jadwalSidang = JadwalSidang::where('nidn_pembimbing', Auth::user()->username)
            ->orWhere('nidn_penguji1', Auth::user()->username)
            ->orWhere('nidn_penguji2', Auth::user()->username)
            ->orWhere('nidn_penguji3', Auth::user()->username)
            ->get();

        return view('dosen.jadwal-sidang', compact('jadwalSidang'));

        
    }


    // public function isiNilai($id)
    // {
    //     $jadwal = JadwalSidang::findOrFail($id);

    //     return view('dosen.jadwal.isi', compact('jadwal'));
    // }

    // public function simpanNilai(Request $request, $id)
    // {
    //     $request->validate([
    //         'nilai_pembimbing' => 'required|numeric|min:0|max:100',
    //         'nilai_penguji1' => 'required|numeric|min:0|max:100',
    //         'nilai_penguji2' => 'required|numeric|min:0|max:100',
    //         'nilai_penguji3' => 'required|numeric|min:0|max:100',
    //     ]);

    //     $jadwal = JadwalSidang::findOrFail($id);
    //     $jadwal->update([
    //         'nilai_pembimbing' => $request->nilai_pembimbing,
    //         'nilai_penguji1' => $request->nilai_penguji1,
    //         'nilai_penguji2' => $request->nilai_penguji2,
    //         'nilai_penguji3' => $request->nilai_penguji3,
    //     ]);

    //     return redirect()->route('dosen.jadwal.sidang')->with('success', 'Nilai berhasil disimpan.');
    // }

    public function isiNilai($id)
    {
        $jadwal = JadwalSidang::findOrFail($id, $isEdit = false);
        $isPembimbing = Auth::user()->nidn == $jadwal->nidn_pembimbing;

        // Komponen Penilaian
        $komponenPenguji = [
            'Komponen 1', 'Komponen 2', 'Komponen 3', 'Komponen 4', 
            'Komponen 5', 'Komponen 6', 'Komponen 7', 'Komponen 8', 
            'Komponen 9', 'Komponen 10', 'Komponen 11', 'Komponen 12',
            'Komponen 13', 'Komponen 14', 'Komponen 15', 'Komponen 16',
            'Komponen 17', 'Komponen 18'
        ];
        $komponenPembimbing = [
            'Tata Tulis', 'Keaktifan', 'Penguasaan Materi', 'Penyelesaian Masalah'
        ];

        return view('dosen.isi-nilai-sidang', compact('jadwal', 'isPembimbing', 'komponenPenguji', 'komponenPembimbing'));
    }

    public function storeNilai(Request $request, $id)
    {
        $jadwal = JadwalSidang::findOrFail($id);
        $isPembimbing = Auth::user()->nidn == $jadwal->nidn_pembimbing;

        // Simpan nilai penguji
        $nilaiPenguji = array_sum($request->penguji) / count($request->penguji);

        if (Auth::user()->nidn == $jadwal->nidn_penguji1) {
            $jadwal->nilai_penguji1 = $nilaiPenguji;
        } elseif (Auth::user()->nidn == $jadwal->nidn_penguji2) {
            $jadwal->nilai_penguji2 = $nilaiPenguji;
        } elseif (Auth::user()->nidn == $jadwal->nidn_penguji3) {
            $jadwal->nilai_penguji3 = $nilaiPenguji;
        }

        // Simpan nilai pembimbing jika applicable
        if ($isPembimbing) {
            $nilaiPembimbing = array_sum($request->pembimbing) / count($request->pembimbing);
            $jadwal->nilai_pembimbing = $nilaiPembimbing;
        }

        $jadwal->save();

        return redirect()->route('cek-jadwal-sidang')->with('success', 'Nilai Sidang berhasil disimpan');
    }
}
