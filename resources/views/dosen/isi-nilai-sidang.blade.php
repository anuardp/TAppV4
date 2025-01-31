@extends('layouts.dosen-home')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>{{ $isEdit ? 'Edit Nilai Sidang TA' : 'Isi Nilai Sidang TA' }}</h2>

<p>Nama Mahasiswa: {{ $jadwal->mahasiswa->nama_mahasiswa }}</p>
<p>NIM: {{ $jadwal->mahasiswa->nim }}</p>


{{-- <form method="POST" action="{{ $isEdit ? route('dosen.updateNilaiSidang', $jadwal->id_jadwal) : route('dosen.submitNilaiSidang', $jadwal->id_jadwal) }}">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <!-- Tabel Penilaian Penguji -->
    <h3>Penilaian sebagai Penguji</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Komponen Penilaian</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($komponenPenilaianPenguji as $index => $komponen)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $komponen }}</td>
                    @for ($i = 1; $i <= 5; $i++)
                        <td>
                            <input type="radio" name="nilai_penguji[{{ $index }}]" value="{{ $i }}" 
                                {{ isset($nilaiSidangPenguji) && $nilaiSidangPenguji[$index]['p' . ($index + 1)] == $i ? 'checked' : '' }}>
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Catatan Revisi Penguji -->
    <div>
        <label for="catatan_revisi_penguji">Catatan Revisi (Penguji):</label>
        <textarea name="catatan_revisi_penguji" id="catatan_revisi_penguji" rows="4">{{ $nilaiSidangPenguji->catatan_revisi ?? '' }}</textarea>
    </div>

    <!-- Tabel Penilaian Pembimbing -->
    @if ($jadwal->nidn_pembimbing == Auth::user()->nidn)
        <h3>Penilaian sebagai Pembimbing</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Komponen Penilaian</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($komponenPenilaianPembimbing as $index => $komponen)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $komponen }}</td>
                        @for ($i = 1; $i <= 5; $i++)
                            <td>
                                <input type="radio" name="nilai_pembimbing[{{ $index }}]" value="{{ $i }}"
                                    {{ isset($nilaiSidangPembimbing) && $nilaiSidangPembimbing['n' . ($index + 1)] == $i ? 'checked' : '' }}>
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Catatan Revisi Pembimbing -->
        <div>
            <label for="catatan_revisi">Catatan Revisi (Pembimbing):</label>
            <textarea name="catatan_revisi" id="catatan_revisi" rows="4">{{ $nilaiSidangPembimbing->catatan_revisi ?? '' }}</textarea>
        </div>
    @endif

    <button type="submit">Simpan Nilai</button>
</form> --}}

<div class="container">
    <form method="POST" action="{{ $isEdit ? route('dosen.updateNilaiSidang', $jadwal->id_jadwal) : route('dosen.submitNilaiSidang', $jadwal->id_jadwal) }}">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif
        <h4>Penilaian sebagai Penguji</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Komponen Penilaian</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pendahuluan - Rumusan Masalah</td>
                    <td><input type="radio" name="p1" value="1"></td>
                    <td><input type="radio" name="p1" value="2"></td>
                    <td><input type="radio" name="p1" value="3"></td>
                    <td><input type="radio" name="p1" value="4"></td>
                    <td><input type="radio" name="p1" value="5"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pendahuluan - Tujuan Penelitian</td>
                    <td><input type="radio" name="p2" value="1"></td>
                    <td><input type="radio" name="p2" value="2"></td>
                    <td><input type="radio" name="p2" value="3"></td>
                    <td><input type="radio" name="p2" value="4"></td>
                    <td><input type="radio" name="p2" value="5"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pendahuluan - Kontribusi Penelitian</td>
                    <td><input type="radio" name="p3" value="1"></td>
                    <td><input type="radio" name="p3" value="2"></td>
                    <td><input type="radio" name="p3" value="3"></td>
                    <td><input type="radio" name="p3" value="4"></td>
                    <td><input type="radio" name="p3" value="5"></td>
                </tr>
              
                <tr>
                    <td>4</td>
                    <td>Kajian Teoritis - Relevansi dengan Topik yang Diteliti</td>
                    <td><input type="radio" name="kt1" value="1"></td>
                    <td><input type="radio" name="kt1" value="2"></td>
                    <td><input type="radio" name="kt1" value="3"></td>
                    <td><input type="radio" name="kt1" value="4"></td>
                    <td><input type="radio" name="kt1" value="5"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Kajian Teoritis - Daftar Pustaka Terkini</td>
                    <td><input type="radio" name="kt2" value="1"></td>
                    <td><input type="radio" name="kt2" value="2"></td>
                    <td><input type="radio" name="kt2" value="3"></td>
                    <td><input type="radio" name="kt2" value="4"></td>
                    <td><input type="radio" name="kt2" value="5"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Kajian Teoritis - Relevansi Acuan Daftar Pustaka</td>
                    <td><input type="radio" name="kt3" value="1"></td>
                    <td><input type="radio" name="kt3" value="2"></td>
                    <td><input type="radio" name="kt3" value="3"></td>
                    <td><input type="radio" name="kt3" value="4"></td>
                    <td><input type="radio" name="kt3" value="5"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Metode Penelitian - Kesesuaian dengan Masalah</td>
                    <td><input type="radio" name="ml1" value="1"></td>
                    <td><input type="radio" name="ml1" value="2"></td>
                    <td><input type="radio" name="ml1" value="3"></td>
                    <td><input type="radio" name="ml1" value="4"></td>
                    <td><input type="radio" name="ml1" value="5"></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Metode Penelitian - Ketepatan Rancangan/Model Penelitian</td>
                    <td><input type="radio" name="ml2" value="1"></td>
                    <td><input type="radio" name="ml2" value="2"></td>
                    <td><input type="radio" name="ml2" value="3"></td>
                    <td><input type="radio" name="ml2" value="4"></td>
                    <td><input type="radio" name="ml2" value="5"></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Metode Penelitian - Ketepatan Instrumen</td>
                    <td><input type="radio" name="ml3" value="1"></td>
                    <td><input type="radio" name="ml3" value="2"></td>
                    <td><input type="radio" name="ml3" value="3"></td>
                    <td><input type="radio" name="ml3" value="4"></td>
                    <td><input type="radio" name="ml3" value="5"></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Metode Penelitian - Ketepatan dan Ketajaman Analisis</td>
                    <td><input type="radio" name="ml4" value="1"></td>
                    <td><input type="radio" name="ml4" value="2"></td>
                    <td><input type="radio" name="ml4" value="3"></td>
                    <td><input type="radio" name="ml4" value="4"></td>
                    <td><input type="radio" name="ml4" value="5"></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Hasil Penelitian - Manfaat dan Kontribusi Bagi Pengembangan Ilmu</td>
                    <td><input type="radio" name="h1" value="1"></td>
                    <td><input type="radio" name="h1" value="2"></td>
                    <td><input type="radio" name="h1" value="3"></td>
                    <td><input type="radio" name="h1" value="4"></td>
                    <td><input type="radio" name="h1" value="5"></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Hasil Penelitian - Kesesuaian dengan Tujuan Penelitian</td>
                    <td><input type="radio" name="h2" value="1"></td>
                    <td><input type="radio" name="h2" value="2"></td>
                    <td><input type="radio" name="h2" value="3"></td>
                    <td><input type="radio" name="h2" value="4"></td>
                    <td><input type="radio" name="h2" value="5"></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Hasil Penelitian - Kedalaman Pembahasan</td>
                    <td><input type="radio" name="h3" value="1"></td>
                    <td><input type="radio" name="h3" value="2"></td>
                    <td><input type="radio" name="h3" value="3"></td>
                    <td><input type="radio" name="h3" value="4"></td>
                    <td><input type="radio" name="h3" value="5"></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Hasil Penelitian - Kadar Keaslian Tulisan</td>
                    <td><input type="radio" name="h4" value="1"></td>
                    <td><input type="radio" name="h4" value="2"></td>
                    <td><input type="radio" name="h4" value="3"></td>
                    <td><input type="radio" name="h4" value="4"></td>
                    <td><input type="radio" name="h4" value="5"></td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>Sikap Ilmiah - Wawasan Bidang Ilmu</td>
                    <td><input type="radio" name="wbi" value="1"></td>
                    <td><input type="radio" name="wbi" value="2"></td>
                    <td><input type="radio" name="wbi" value="3"></td>
                    <td><input type="radio" name="wbi" value="4"></td>
                    <td><input type="radio" name="wbi" value="5"></td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>Sikap Ilmiah - Kemampuan Presentasi</td>
                    <td><input type="radio" name="kp" value="1"></td>
                    <td><input type="radio" name="kp" value="2"></td>
                    <td><input type="radio" name="kp" value="3"></td>
                    <td><input type="radio" name="kp" value="4"></td>
                    <td><input type="radio" name="kp" value="5"></td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>Sikap Ilmiah - Ketepatan Jawaban</td>
                    <td><input type="radio" name="tepatJ" value="1"></td>
                    <td><input type="radio" name="tepatJ" value="2"></td>
                    <td><input type="radio" name="tepatJ" value="3"></td>
                    <td><input type="radio" name="tepatJ" value="4"></td>
                    <td><input type="radio" name="tepatJ" value="5"></td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>Sikap Ilmiah - Kelancaran Jawaban</td>
                    <td><input type="radio" name="lancarJ" value="1"></td>
                    <td><input type="radio" name="lancarJ" value="2"></td>
                    <td><input type="radio" name="lancarJ" value="3"></td>
                    <td><input type="radio" name="lancarJ" value="4"></td>
                    <td><input type="radio" name="lancarJ" value="5"></td>
                </tr>
            </tbody>
        </table>

        @if ($jadwal->nidn_pembimbing == Auth::user()->username)
        <h4>Penilaian sebagai Pembimbing</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Komponen Penilaian</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tata Tulis</td>
                    <td><input type="radio" name="nilai_tata_tulis" value="1"></td>
                    <td><input type="radio" name="nilai_tata_tulis" value="2"></td>
                    <td><input type="radio" name="nilai_tata_tulis" value="3"></td>
                    <td><input type="radio" name="nilai_tata_tulis" value="4"></td>
                    <td><input type="radio" name="nilai_tata_tulis" value="5"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Keaktifan</td>
                    <td><input type="radio" name="nilai_keaktifan" value="1"></td>
                    <td><input type="radio" name="nilai_keaktifan" value="2"></td>
                    <td><input type="radio" name="nilai_keaktifan" value="3"></td>
                    <td><input type="radio" name="nilai_keaktifan" value="4"></td>
                    <td><input type="radio" name="nilai_keaktifan" value="5"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Penguasaan Materi</td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="1"></td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="2"></td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="3"></td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="4"></td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="5"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Penyelesaian Masalah</td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="1"></td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="2"></td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="3"></td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="4"></td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="5"></td>
                </tr>
            </tbody>
        </table>
        @endif

        <div class="form-group">
            <label for="catatan_revisi">Catatan Revisi</label>
            <textarea name="catatan_revisi" id="catatan_revisi" rows="3" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
    </form>
</div>
@endsection