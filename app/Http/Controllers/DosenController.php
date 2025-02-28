<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use App\Models\NilaiSidangPenguji;
use Illuminate\Support\Facades\Auth;
use App\Models\NilaiSidangPembimbing;
use App\Models\Dosen;
use App\Models\Mahasiswa;

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

    public function isiNilai($idJadwal)
    {

        $jadwal = JadwalSidang::with(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing'])->findOrFail($idJadwal);
        $isEdit = false;

       

        return view('dosen.isi-nilai-sidang', compact('jadwal', 'isEdit'));
    }

    public function editNilai($idJadwal)
    {
        $jadwal = JadwalSidang::with('mahasiswa', 'penguji1', 'penguji2', 'pembimbing')->findOrFail($idJadwal);
        $isEdit = true;

        $nilaiSidangPenguji = NilaiSidangPenguji::where('id_jadwal', $idJadwal)->first();
        $nilaiSidangPembimbing = NilaiSidangPembimbing::where('id_jadwal', $idJadwal)->first();

        if(Auth::user()->username === $jadwal->nidn_penguji1){
            $statusPenilai = 'penguji1';
        }
        else if(Auth::user()->username === $jadwal->nidn_penguji2){
            $statusPenilai = 'penguji2';
        }
        else if(Auth::user()->username === $jadwal->nidn_penguji3){
            $statusPenilai = 'penguji3';
        }

        // $jadwalSidang = JadwalSidang::where('nidn_pembimbing', Auth::user()->username)
        //     ->orWhere('nidn_penguji1', Auth::user()->username)
        //     ->orWhere('nidn_penguji2', Auth::user()->username)
        //     ->orWhere('nidn_penguji3', Auth::user()->username)
        //     ->get();

        $penguji = NilaiSidangPenguji::where('id_jadwal', $idJadwal)
                    ->where('status_penilai', $statusPenilai)->first();

        return view('dosen.edit-nilai-sidang', compact(
            'jadwal',
            'nilaiSidangPenguji',
            'nilaiSidangPembimbing',
            'penguji',
            'isEdit'
        ));
    }

    public function submitNilaiSidang(Request $request, $idJadwal)
    {
        // Validasi input
        $validated = $request->validate([
            'p1' => 'nullable|integer|min:1|max:5',
            'p2' => 'nullable|integer|min:1|max:5',
            'p3' => 'nullable|integer|min:1|max:5',
            'kt1' => 'nullable|integer|min:1|max:5',
            'kt2' => 'nullable|integer|min:1|max:5',
            'kt3' => 'nullable|integer|min:1|max:5',
            'ml1' => 'nullable|integer|min:1|max:5',
            'ml2' => 'nullable|integer|min:1|max:5',
            'ml3' => 'nullable|integer|min:1|max:5',
            'ml4' => 'nullable|integer|min:1|max:5',
            'h1' => 'nullable|integer|min:1|max:5',
            'h2' => 'nullable|integer|min:1|max:5',
            'h3' => 'nullable|integer|min:1|max:5',
            'h4' => 'nullable|integer|min:1|max:5',
            'wbi' => 'nullable|integer|min:1|max:5',
            'kp' => 'nullable|integer|min:1|max:5',
            'tepatJ' => 'nullable|integer|min:1|max:5',
            'lancarJ' => 'nullable|integer|min:1|max:5',
            'catatan_revisi' => 'nullable|string|max:255',
            'nilai_tata_tulis' => 'nullable|integer|min:1|max:5',
            'nilai_keaktifan' => 'nullable|integer|min:1|max:5',
            'nilai_penguasaan_materi' => 'nullable|integer|min:1|max:5',
            'nilai_penyelesaian_masalah' => 'nullable|integer|min:1|max:5',
            'catatan_revisi' => 'nullable|string|max:2550',
        ]);

        // Ambil data jadwal sidang berdasarkan ID
        $jadwal = JadwalSidang::findOrFail($idJadwal);
        
        if(Auth::user()->username === $jadwal->nidn_penguji1){
            $statusPenguji = 'penguji1';
        }
        else if(Auth::user()->username === $jadwal->nidn_penguji2){
            $statusPenguji = 'penguji2';
        }
        else if(Auth::user()->username === $jadwal->nidn_penguji3){
            $statusPenguji = 'penguji3';
        }

        $penguji = NilaiSidangPenguji::where('id_jadwal', $idJadwal)->where('status_penilai', $statusPenguji);

        $totalNilai = 0;
        $jumlahKomponen = 18;

        $totalNilai +=  $validated['p1'] + 
                        $validated['p2'] +
                        $validated['p3'] +
                        $validated['kt1']+
                        $validated['kt2']+
                        $validated['kt3']+
                        $validated['ml1']+
                        $validated['ml2']+
                        $validated['ml3']+
                        $validated['ml4']+
                        $validated['h1']+
                        $validated['h2']+
                        $validated['h3']+
                        $validated['h4']+
                        $validated['wbi']+
                        $validated['kp']+
                        $validated['tepatJ']+
                        $validated['lancarJ'];

        $nilaiAkhirPenguji = $totalNilai * 100 / 90;

        // Proses nilai penguji
        if ($statusPenguji === 'penguji1') {
            // Simpan ke tabel nilaiSidangPenguji
            NilaiSidangPenguji::updateOrCreate(
                ['id_jadwal' => $idJadwal, 'status_penilai' => $statusPenguji],
                [
                    'p1' => $validated['p1'],
                    'p2' => $validated['p2'],
                    'p3' => $validated['p3'],
                    'kt1' => $validated['kt1'],
                    'kt2' => $validated['kt2'],
                    'kt3' => $validated['kt3'],
                    'ml1' => $validated['ml1'],
                    'ml2' => $validated['ml2'],
                    'ml3' => $validated['ml3'],
                    'ml4' => $validated['ml4'],
                    'h1' => $validated['h1'],
                    'h2' => $validated['h2'],
                    'h3' => $validated['h3'],
                    'h4' => $validated['h4'],
                    'wbi' => $validated['wbi'],
                    'kp' => $validated['kp'],
                    'tepatJ' => $validated['tepatJ'],
                    'lancarJ' => $validated['lancarJ'],
                    'nilai_akhir_sidang' => $nilaiAkhirPenguji,
                    'catatan_revisi' => $validated['catatan_revisi'],
                ]
            );

            // Update nilai penguji pada tabel jadwal sidang
            $jadwal->update(['nilai_penguji1' => $nilaiAkhirPenguji]);
        }
        else if ($statusPenguji === 'penguji2') {

            NilaiSidangPenguji::updateOrCreate(
                ['id_jadwal' => $idJadwal, 'status_penilai' => $statusPenguji],
                [
                    'p1' => $validated['p1'],
                    'p2' => $validated['p2'],
                    'p3' => $validated['p3'],
                    'kt1' => $validated['kt1'],
                    'kt2' => $validated['kt2'],
                    'kt3' => $validated['kt3'],
                    'ml1' => $validated['ml1'],
                    'ml2' => $validated['ml2'],
                    'ml3' => $validated['ml3'],
                    'ml4' => $validated['ml4'],
                    'h1' => $validated['h1'],
                    'h2' => $validated['h2'],
                    'h3' => $validated['h3'],
                    'h4' => $validated['h4'],
                    'wbi' => $validated['wbi'],
                    'kp' => $validated['kp'],
                    'tepatJ' => $validated['tepatJ'],
                    'lancarJ' => $validated['lancarJ'],
                    'nilai_akhir_sidang' => $nilaiAkhirPenguji,
                    'catatan_revisi' => $validated['catatan_revisi'],
                ]
            );

            // Update nilai penguji pada tabel jadwal sidang
            $jadwal->update(['nilai_penguji2' => $nilaiAkhirPenguji]);
        }
        else if ($statusPenguji === 'penguji3') {
            NilaiSidangPenguji::updateOrCreate(
                ['id_jadwal' => $idJadwal, 'status_penilai' => $statusPenguji],
                [
                    'p1' => $validated['p1'],
                    'p2' => $validated['p2'],
                    'p3' => $validated['p3'],
                    'kt1' => $validated['kt1'],
                    'kt2' => $validated['kt2'],
                    'kt3' => $validated['kt3'],
                    'ml1' => $validated['ml1'],
                    'ml2' => $validated['ml2'],
                    'ml3' => $validated['ml3'],
                    'ml4' => $validated['ml4'],
                    'h1' => $validated['h1'],
                    'h2' => $validated['h2'],
                    'h3' => $validated['h3'],
                    'h4' => $validated['h4'],
                    'wbi' => $validated['wbi'],
                    'kp' => $validated['kp'],
                    'tepatJ' => $validated['tepatJ'],
                    'lancarJ' => $validated['lancarJ'],
                    'nilai_akhir_sidang' => $nilaiAkhirPenguji,
                    'catatan_revisi' => $validated['catatan_revisi'],
                ]
            );

            // Update nilai penguji pada tabel jadwal sidang
            $jadwal->update(['nilai_penguji3' => $nilaiAkhirPenguji]);
        }

        // Proses nilai pembimbing
        if ($statusPenguji === 'penguji3') {
            $nilaiTataTulis = $validated['nilai_tata_tulis'];
            $nilaiKeaktifan = $validated['nilai_keaktifan'];
            $nilaiPenguasaanMateri = $validated['nilai_penguasaan_materi'];
            $nilaiPenyelesaianMasalah = $validated['nilai_penyelesaian_masalah'];

            $nilaiAkhirPembimbing = ($nilaiTataTulis + $nilaiKeaktifan + $nilaiPenguasaanMateri + $nilaiPenyelesaianMasalah) * 100 / 20;

            // Simpan ke tabel nilaiSidangPembimbing
            NilaiSidangPembimbing::updateOrCreate(
                ['id_jadwal' => $idJadwal],
                [
                    'nilai_tata_tulis' => $nilaiTataTulis,
                    'nilai_keaktifan' => $nilaiKeaktifan,
                    'nilai_penguasaan_materi' => $nilaiPenguasaanMateri,
                    'nilai_penyelesaian_masalah' => $nilaiPenyelesaianMasalah,
                    'nilai_akhir_sidang' => $nilaiAkhirPembimbing,
                    'catatan_revisi' => $validated['catatan_revisi'],
                ]
            );

            // Update nilai pembimbing pada tabel jadwal sidang
            $jadwal->update(['nilai_pembimbing' => $nilaiAkhirPembimbing]);
        }  
        
        if($jadwal->nilai_penguji1 !== null  && $jadwal->nilai_penguji2 !== null && $jadwal->nilai_penguji3 !== null && $jadwal->nilai_pembimbing !== null){
            $jadwal->update(['nilai_akhir' => ($jadwal->nilai_penguji1 + $jadwal->nilai_penguji2 + $jadwal->nilai_penguji3 + $jadwal->nilai_pembimbing) / 4]);           
        }



        return redirect()->route('dosen.jadwal.sidang')->with('success', 'Nilai sidang berhasil disimpan.');
    }


    public function updateNilaiSidang(Request $request, $idJadwal)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'p1' => 'nullable|integer|min:1|max:5',
            'p2' => 'nullable|integer|min:1|max:5',
            'p3' => 'nullable|integer|min:1|max:5',
            'kt1' => 'nullable|integer|min:1|max:5',
            'kt2' => 'nullable|integer|min:1|max:5',
            'kt3' => 'nullable|integer|min:1|max:5',
            'ml1' => 'nullable|integer|min:1|max:5',
            'ml2' => 'nullable|integer|min:1|max:5',
            'ml3' => 'nullable|integer|min:1|max:5',
            'ml4' => 'nullable|integer|min:1|max:5',
            'h1' => 'nullable|integer|min:1|max:5',
            'h2' => 'nullable|integer|min:1|max:5',
            'h3' => 'nullable|integer|min:1|max:5',
            'h4' => 'nullable|integer|min:1|max:5',
            'wbi' => 'nullable|integer|min:1|max:5',
            'kp' => 'nullable|integer|min:1|max:5',
            'tepatJ' => 'nullable|integer|min:1|max:5',
            'lancarJ' => 'nullable|integer|min:1|max:5',
            'nilai_tata_tulis' => 'nullable|integer|min:1|max:5',
            'nilai_keaktifan' => 'nullable|integer|min:1|max:5',
            'nilai_penguasaan_materi' => 'nullable|integer|min:1|max:5',
            'nilai_penyelesaian_masalah' => 'nullable|integer|min:1|max:5',
            'catatan_revisi' => 'nullable|string|max:255',
    
        ]);

        // Ambil jadwal sidang
        $jadwal = JadwalSidang::findOrFail($idJadwal);

        // Cek status dosen apakah sebagai pembimbing atau penguji
        // $statusPenilai = Auth::user()->status_penilai;
        if(Auth::user()->username === $jadwal->nidn_penguji1){
            $statusPenilai = 'penguji1';
        }
        else if(Auth::user()->username === $jadwal->nidn_penguji2){
            $statusPenilai = 'penguji2';
        }
        else if(Auth::user()->username === $jadwal->nidn_penguji3){
            $statusPenilai = 'penguji3';
        }

        if (in_array($statusPenilai, ['penguji1', 'penguji2', 'penguji3'])) {
            // Hitung nilai akhir untuk penguji
            $totalPenguji = array_sum([
                $validated['p1'], $validated['p2'], $validated['p3'],
                $validated['kt1'], $validated['kt2'], $validated['kt3'],
                $validated['ml1'], $validated['ml2'], $validated['ml3'], $validated['ml4'],
                $validated['h1'], $validated['h2'], $validated['h3'], $validated['h4'],
                $validated['wbi'], $validated['kp'], $validated['tepatJ'], $validated['lancarJ']
            ]);
            $nilaiAkhirPenguji = $totalPenguji * 100 / 90;

            // Update tabel nilai_sidang_penguji
            NilaiSidangPenguji::updateOrCreate(
                ['id_jadwal' => $idJadwal, 'status_penilai' => $statusPenilai],
                [
                    'p1' => $validated['p1'],
                    'p2' => $validated['p2'],
                    'p3' => $validated['p3'],
                    'kt1' => $validated['kt1'],
                    'kt2' => $validated['kt2'],
                    'kt3' => $validated['kt3'],
                    'ml1' => $validated['ml1'],
                    'ml2' => $validated['ml2'],
                    'ml3' => $validated['ml3'],
                    'ml4' => $validated['ml4'],
                    'h1' => $validated['h1'],
                    'h2' => $validated['h2'],
                    'h3' => $validated['h3'],
                    'h4' => $validated['h4'],
                    'wbi' => $validated['wbi'],
                    'kp' => $validated['kp'],
                    'tepatJ' => $validated['tepatJ'],
                    'lancarJ' => $validated['lancarJ'],
                    'catatan_revisi' => $validated['catatan_revisi'],
                    'nilai_akhir_sidang' => $nilaiAkhirPenguji,
                ]
            );
        }

        if ($statusPenilai == 'pembimbing') {
            // Hitung nilai akhir untuk pembimbing
            $totalPembimbing = array_sum([
                $validated['nilai_tata_tulis'],
                $validated['nilai_keaktifan'],
                $validated['nilai_penguasaan_materi'],
                $validated['nilai_penyelesaian_masalah']
            ]);
            $nilaiAkhirPembimbing = $totalPembimbing * 100 / 20;

            // Update tabel nilai_sidang_pembimbing
            NilaiSidangPembimbing::updateOrCreate(
                ['id_jadwal' => $idJadwal],
                [
                    'nilai_tata_tulis' => $validated['nilai_tata_tulis'],
                    'nilai_keaktifan' => $validated['nilai_keaktifan'],
                    'nilai_penguasaan_materi' => $validated['nilai_penguasaan_materi'],
                    'nilai_penyelesaian_masalah' => $validated['nilai_penyelesaian_masalah'],
                    'catatan_revisi' => $validated['catatan_revisi'],
                    'nilai_akhir_sidang' => $nilaiAkhirPembimbing,
                ]
            );
        }

        // Update nilai di tabel jadwal sidang
        if ($statusPenilai == 'pembimbing') {
            $jadwal->update(['nilai_pembimbing' => $nilaiAkhirPembimbing]);
        } elseif ($statusPenilai == 'penguji1') {
            $jadwal->update(['nilai_penguji1' => $nilaiAkhirPenguji]);
        } elseif ($statusPenilai == 'penguji2') {
            $jadwal->update(['nilai_penguji2' => $nilaiAkhirPenguji]);
        } elseif ($statusPenilai == 'penguji3') {
            $jadwal->update(['nilai_penguji3' => $nilaiAkhirPenguji]);
        }   

        return redirect()->route('dosen.jadwal.sidang')->with('success', 'Nilai berhasil diperbarui.');
    }
}
