<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use App\Models\NilaiSidangPenguji;
use Illuminate\Support\Facades\Auth;
use App\Models\NilaiSidangPembimbing;

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
        // $jadwal = JadwalSidang::findOrFail($id, $isEdit = false);
        // $isPembimbing = Auth::user()->nidn == $jadwal->nidn_pembimbing;

        $jadwal = JadwalSidang::with(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing'])->findOrFail($idJadwal);
        $isEdit = false;

        // Komponen Penilaian
        $komponenPenilaianPenguji = [
            'Komponen 1', 'Komponen 2', 'Komponen 3', 'Komponen 4', 
            'Komponen 5', 'Komponen 6', 'Komponen 7', 'Komponen 8', 
            'Komponen 9', 'Komponen 10', 'Komponen 11', 'Komponen 12',
            'Komponen 13', 'Komponen 14', 'Komponen 15', 'Komponen 16',
            'Komponen 17', 'Komponen 18'
        ];
        $komponenPenilaianPembimbing = [
            'Tata Tulis', 'Keaktifan', 'Penguasaan Materi', 'Penyelesaian Masalah'
        ];

        return view('dosen.isi-nilai-sidang', compact('jadwal', 'komponenPenilaianPenguji', 'komponenPenilaianPembimbing', 'isEdit'));
    }

    public function editNilai($idJadwal)
    {
        $jadwal = JadwalSidang::with('mahasiswa', 'penguji1', 'penguji2', 'pembimbing')->findOrFail($idJadwal);
        $isEdit = true;

        $nilaiSidangPenguji = NilaiSidangPenguji::where('id_jadwal', $idJadwal)->first();
        $nilaiSidangPembimbing = NilaiSidangPembimbing::where('id_jadwal', $idJadwal)->first();

        $komponenPenilaianPenguji = [
            'Komponen 1', 'Komponen 2', 'Komponen 3', 'Komponen 4', 
            'Komponen 5', 'Komponen 6', 'Komponen 7', 'Komponen 8', 
            'Komponen 9', 'Komponen 10', 'Komponen 11', 'Komponen 12',
            'Komponen 13', 'Komponen 14', 'Komponen 15', 'Komponen 16',
            'Komponen 17', 'Komponen 18'
        ];

        $komponenPenilaianPembimbing = [
            'Tata Tulis',
            'Keaktifan Mahasiswa',
            'Penguasaan Materi',
            'Penyelesaian Masalah',
        ];

        return view('dosen.isi-nilai-sidang', compact(
            'jadwal',
            'nilaiSidangPenguji',
            'nilaiSidangPembimbing',
            'komponenPenilaianPenguji',
            'komponenPenilaianPembimbing',
            'isEdit'
        ));
    }

    // public function submitNilaiSidang(Request $request, $id)
    // {
    //     $jadwal = JadwalSidang::findOrFail($id);
    //     $isPembimbing = Auth::user()->nidn == $jadwal->nidn_pembimbing;

    //     // Simpan nilai penguji
    //     $nilaiPenguji = array_sum($request->penguji) / count($request->penguji);

    //     if (Auth::user()->nidn == $jadwal->nidn_penguji1) {
    //         $jadwal->nilai_penguji1 = $nilaiPenguji;
    //     } elseif (Auth::user()->nidn == $jadwal->nidn_penguji2) {
    //         $jadwal->nilai_penguji2 = $nilaiPenguji;
    //     } elseif (Auth::user()->nidn == $jadwal->nidn_penguji3) {
    //         $jadwal->nilai_penguji3 = $nilaiPenguji;
    //     }

    //     // Simpan nilai pembimbing jika applicable
    //     if ($isPembimbing) {
    //         $nilaiPembimbing = array_sum($request->pembimbing) / count($request->pembimbing);
    //         $jadwal->nilai_pembimbing = $nilaiPembimbing;
    //     }

    //     $jadwal->save();

    //     return redirect()->route('cek-jadwal-sidang')->with('success', 'Nilai Sidang berhasil disimpan');
    // }

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
            'catatan_revisi' => 'nullable|string|max:255',
        ]);

        // Ambil data jadwal sidang berdasarkan ID
        $jadwal = JadwalSidang::findOrFail($idJadwal);

        // Proses nilai penguji
        if ($jadwal->status_penilai === 'penguji1') {
            $totalNilai = 0;
            $jumlahKomponen = 18;

            foreach ($validated as $key => $value) {
                if (str_contains($key, 'nilai_penguji1')) {
                    $totalNilai += $value;
                }
            }

            $nilaiAkhirPenguji = $totalNilai / $jumlahKomponen;

            // Simpan ke tabel nilaiSidangPenguji
            NilaiSidangPenguji::updateOrCreate(
                ['id_jadwal' => $idJadwal],
                [
                    'nilai_akhir_sidang' => $nilaiAkhirPenguji,
                    'catatan_revisi' => $request->catatan_revisi,
                ]
            );

            // Update nilai penguji pada tabel jadwal sidang
            $jadwal->update(['nilai_penguji1' => $nilaiAkhirPenguji]);
        }
        else if ($jadwal->status_penilai === 'penguji2') {
            $totalNilai = 0;
            $jumlahKomponen = 18;

            foreach ($validated as $key => $value) {
                if (str_contains($key, 'nilai_penguji2')) {
                    $totalNilai += $value;
                }
            }

            $nilaiAkhirPenguji = $totalNilai / $jumlahKomponen;

            // Simpan ke tabel nilaiSidangPenguji
            NilaiSidangPenguji::updateOrCreate(
                ['id_jadwal' => $idJadwal],
                [
                    'nilai_akhir_sidang' => $nilaiAkhirPenguji,
                    'catatan_revisi' => $request->catatan_revisi,
                ]
            );

            // Update nilai penguji pada tabel jadwal sidang
            $jadwal->update(['nilai_penguji2' => $nilaiAkhirPenguji]);
        }
        else if ($jadwal->status_penilai === 'penguji3') {
            $totalNilai = 0;
            $jumlahKomponen = 18;

            foreach ($validated as $key => $value) {
                if (str_contains($key, 'nilai_penguji3')) {
                    $totalNilai += $value;
                }
            }

            $nilaiAkhirPenguji = $totalNilai / $jumlahKomponen;

            // Simpan ke tabel nilaiSidangPenguji
            NilaiSidangPenguji::updateOrCreate(
                ['id_jadwal' => $idJadwal],
                [
                    'nilai_akhir_sidang' => $nilaiAkhirPenguji,
                    'catatan_revisi' => $request->catatan_revisi,
                ]
            );

            // Update nilai penguji pada tabel jadwal sidang
            $jadwal->update(['nilai_penguji3' => $nilaiAkhirPenguji]);
        }

        // Proses nilai pembimbing
        if ($jadwal->status_penilai === 'pembimbing') {
            $nilaiTataTulis = $request->input('nilai_tata_tulis');
            $nilaiKeaktifan = $request->input('nilai_keaktifan');
            $nilaiPenguasaanMateri = $request->input('nilai_penguasaan_materi');
            $nilaiPenyelesaianMasalah = $request->input('nilai_penyelesaian_masalah');

            $nilaiAkhirPembimbing = (
                $nilaiTataTulis +
                $nilaiKeaktifan +
                $nilaiPenguasaanMateri +
                $nilaiPenyelesaianMasalah
            ) / 4;

            // Simpan ke tabel nilaiSidangPembimbing
            NilaiSidangPembimbing::updateOrCreate(
                ['id_jadwal' => $idJadwal],
                [
                    'nilai_tata_tulis' => $nilaiTataTulis,
                    'nilai_keaktifan' => $nilaiKeaktifan,
                    'nilai_penguasaan_materi' => $nilaiPenguasaanMateri,
                    'nilai_penyelesaian_masalah' => $nilaiPenyelesaianMasalah,
                    'nilai_akhir_sidang' => $nilaiAkhirPembimbing,
                    'catatan_revisi' => $request->catatan_revisi,
                ]
            );

            // Update nilai pembimbing pada tabel jadwal sidang
            $jadwal->update(['nilai_pembimbing' => $nilaiAkhirPembimbing]);
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
            'catatan_revisi' => 'nullable|string|max:255',
            'nilai_tata_tulis' => 'nullable|integer|min:1|max:5',
            'nilai_keaktifan' => 'nullable|integer|min:1|max:5',
            'nilai_penguasaan_materi' => 'nullable|integer|min:1|max:5',
            'nilai_penyelesaian_masalah' => 'nullable|integer|min:1|max:5',
            'catatan_revisi' => 'nullable|string|max:255',
        ]);

        // Ambil jadwal sidang
        $jadwal = JadwalSidang::findOrFail($idJadwal);

        // Cek status dosen apakah sebagai pembimbing atau penguji
        $statusPenilai = Auth::user()->status_penilai;

        if (in_array($statusPenilai, ['penguji1', 'penguji2', 'penguji3'])) {
            // Hitung nilai akhir untuk penguji
            $totalPenguji = array_sum([
                $validated['p1'], $validated['p2'], $validated['p3'],
                $validated['kt1'], $validated['kt2'], $validated['kt3'],
                $validated['ml1'], $validated['ml2'], $validated['ml3'], $validated['ml4'],
                $validated['h1'], $validated['h2'], $validated['h3'], $validated['h4'],
                $validated['wbi'], $validated['kp'], $validated['tepatJ'], $validated['lancarJ']
            ]);
            $nilaiAkhirPenguji = $totalPenguji / 18;

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
            $nilaiAkhirPembimbing = $totalPembimbing / 4;

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
