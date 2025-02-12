<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use App\Models\NilaiSidangPenguji;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\NilaiSidangPembimbing;

class AdminController extends Controller
{
    public function createMahasiswa()
    {
        return view('admin.create_mahasiswa');
    }

    public function storeMahasiswa(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|unique:mahasiswa,nim|max:20',
            'nama_mahasiswa' => 'required|string|max:255',
            'angkatan' => 'required|integer',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        // $mahasiswa = Mahasiswa::create($request->all());
        $mahasiswa = Mahasiswa::create($validated);
        
        User::create([
            'username' => $mahasiswa->nim,
            'password' => Hash::make($mahasiswa->nim . $mahasiswa->angkatan),
            'role' => 'mahasiswa',
        ]);

        return redirect()->back()->with('success', 'Data Mahasiswa berhasil disimpan!');
    }

    public function createDosen()
    {
        return view('admin.create_dosen');
    }

    public function storeDosen(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|string|unique:dosen,nidn|max:20',
            'nama_dosen' => 'required|string|max:255',
            'tahun_mulai_mengajar' => 'required|integer',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'jabatan_fungsional' => 'required|string|max:255',
            'alamat' => 'required|string|max:255'
        ]);

        $dosen = Dosen::create($validated); 

        User::create([
            'username' => $dosen->nidn,
            'password' => Hash::make($dosen->nidn . $dosen->tahun_mulai_mengajar),
            'role' => 'dosen',
        ]);

        return redirect()->back()->with('success', 'Data Dosen berhasil disimpan!');
    }

    public function editMahasiswa($id){
        // $mhs = Mahasiswa::findOrFail($id);
        $mhs = Mahasiswa::findOrFail($id);
        
        return view('admin.edit_mahasiswa', compact('mhs'));
    }

    // \\Log::info('Data yang dikirim:', $request->all());

    public function updateMahasiswa(Request $request, $id){
        $mhs = Mahasiswa::findOrFail($id);

        // dd($request->all());
        // dd($request->id_mahasiswa);

        // if (!$mhs) {
        //     dd('Mahasiswa tidak ditemukan dengan ID: ' . $id);
        // }

        if (!$mhs) {
            return redirect()->route('daftar.mahasiswa')->with('error', 'Mahasiswa tidak ditemukan.');
        }
    
        $validated = $request->validate([
            'nim' => 'required|string|unique:mahasiswa,nim|max:20',
            'nama_mahasiswa' => 'required|string|max:255',
            'angkatan' => 'required|integer',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $mhs->update(
            // ['id_mahasiswa' => $id],
            // ['nim' => $validated['nim'],
            // 'nama_mahasiswa' => $validated['nama_mahasiswa'],
            // 'angkatan' => $validated['angkatan'],
            // 'fakultas' => $validated['fakultas'],
            // 'prodi' => $validated['prodi'],
            // 'judul' => $validated['judul'],
            // 'email' => $validated['email'],
            // 'nomor_telepon' => $validated['nomor_telepon'],
            // 'alamat' => $validated['alamat'],
            ['nim' => $validated['nim'],
            'nama_mahasiswa' => $validated['nama_mahasiswa'],
            'angkatan' => $validated['angkatan'],
            'fakultas' => $validated['fakultas'],
            'prodi' => $validated['prodi'],
            'judul' => $validated['judul'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'alamat' => $validated['alamat'],
        ]);
        // $mhs->save();
    
        return redirect()->route('daftar.mahasiswa')->with(['success', 'Data mahasiswa berhasil diperbarui!']);
    }

    public function daftarMahasiswa()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.daftar-mahasiswa', compact('mahasiswa'));
    }

    public function daftarDosen()
    {
        $dosen = Dosen::all();
        return view('admin.daftar-dosen', compact('dosen'));
    }

    public function formJadwalSidang()
    {
        return view('admin.jadwal-create');
    }

    public function storeJadwalSidang(Request $request)
    { 
        $validated = $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'tanggal_sidang' => 'required|date',
            'waktu_sidang' => 'required',
            'nidn_pembimbing' => 'required|exists:dosen,nidn',
            'nidn_penguji1' => 'required|exists:dosen,nidn',
            'nidn_penguji2' => 'required|exists:dosen,nidn',
        ]);

        $jadwal = JadwalSidang::create(array_merge($validated, [
            'nidn_penguji3' => $validated['nidn_pembimbing'],
        ]));

        return redirect()->route('admin.jadwal.create')->with('success', 'Jadwal sidang berhasil dibuat');
    }

    public function listJadwalSidang()
    {
        $jadwalSidang = JadwalSidang::join('mahasiswa', 'jadwal_sidang.nim', '=', 'mahasiswa.nim')
            ->join('dosen as pembimbing', 'jadwal_sidang.nidn_pembimbing', '=', 'pembimbing.nidn')
            ->join('dosen as penguji1', 'jadwal_sidang.nidn_penguji1', '=', 'penguji1.nidn')
            ->join('dosen as penguji2', 'jadwal_sidang.nidn_penguji2', '=', 'penguji2.nidn')
            ->select(
                'jadwal_sidang.*',  
                'mahasiswa.judul as judul_ta',
                'pembimbing.nama_dosen as nama_pembimbing',
                'penguji1.nama_dosen as nama_penguji1',
                'penguji2.nama_dosen as nama_penguji2'
            )
            ->get();

        return view('admin.jadwal-sidang', compact('jadwalSidang'));
    }
    
    public function updateStatusSidang(Request $request, $id)
    {
        // Temukan jadwal sidang berdasarkan ID
        $jadwal = JadwalSidang::findOrFail($id);

        // Pastikan status_sidang belum "sudah"
        if ($jadwal->status_sidang === 'sudah') {
            return redirect()->back()->with('error', 'Sidang sudah diselesaikan sebelumnya.');
        }

        // Update status sidang pada tabel jadwal_sidang dan mahasiswa
        $jadwal->update(['status_sidang' => 'sudah']);
        Mahasiswa::where('nim', $jadwal->nim)->update(['status_sidang' => 'sudah']);

        // Tambahkan data ke tabel nilaiSidangPenguji dan nilaiSidangPembimbing
        $this->createNilaiSidang($jadwal);

        return redirect()->back()->with('success', 'Status sidang berhasil diperbarui.');
    }

    private function createNilaiSidang($jadwal)
    {
        $mahasiswa = Mahasiswa::where('nim', $jadwal->nim)->first();
        
        // Tambahkan data ke nilaiSidangPenguji
        foreach (['nidn_penguji1', 'nidn_penguji2', 'nidn_penguji3'] as $key => $penguji) {
            if (!empty($jadwal->$penguji)) {
                NilaiSidangPenguji::create([
                    'id_jadwal' => $jadwal->id_jadwal,
                    'nama_dosen' => Dosen::where('nidn', $jadwal->$penguji)->first()->nama_dosen,
                    'nama_mahasiswa' => $mahasiswa->nama_mahasiswa,
                    'tanggal_sidang' => $jadwal->tanggal_sidang,
                    'waktu_sidang' => $jadwal->waktu_sidang,
                    'status_penilai' => "penguji" . ($key + 1),
                ]);
            }
        }

        // Tambahkan data ke nilaiSidangPembimbing jika ada pembimbing
        if (!empty($jadwal->nidn_pembimbing)) {
            NilaiSidangPembimbing::create([
                'id_jadwal' => $jadwal->id_jadwal,
                'nama_dosen' => Dosen::where('nidn', $jadwal->nidn_pembimbing)->first()->nama_dosen,
                'nama_mahasiswa' => $mahasiswa->nama_mahasiswa,
                'tanggal_sidang' => $jadwal->tanggal_sidang,
                'waktu_sidang' => $jadwal->waktu_sidang,
            ]);
        }
    }

    public function listNilaiMahasiswa()
    {
        $daftarNilaiMahasiswa = Mahasiswa::join('jadwal_sidang', 'jadwal_sidang.nim', '=', 'mahasiswa.nim')
            // ->join('dosen as pembimbing', 'jadwal_sidang.nidn_pembimbing', '=', 'pembimbing.nidn')
            // ->join('dosen as penguji1', 'jadwal_sidang.nidn_penguji1', '=', 'penguji1.nidn')
            // ->join('dosen as penguji2', 'jadwal_sidang.nidn_penguji2', '=', 'penguji2.nidn')
            ->select(
                'mahasiswa.nim',
                'mahasiswa.nama_mahasiswa',  
                'mahasiswa.judul as judul_ta',
                'jadwal_sidang.nilai_pembimbing as nilai_pembimbing',
                'jadwal_sidang.nilai_penguji1 as nilai_penguji1',
                'jadwal_sidang.nilai_penguji2 as nilai_penguji2',
                'jadwal_sidang.nilai_penguji3 as nilai_penguji3',
                'jadwal_sidang.nilai_akhir as nilai_akhir',
            )
            ->get();

        return view('admin.daftar_nilai_mahasiswa', compact('daftarNilaiMahasiswa'));
    }
}


