@extends('layouts.dosen-home')

{{-- @section('content')
    <div class="container">
        <h2>Jadwal Sidang Saya</h2>
        <p>Catatan: </p>
        <p>Rentang nilai 1-5, terdiri atas</p>
        <ol>
            <li>Sangat Tidak Baik</li>
            <li>Tidak Baik</li>
            <li>Cukup</li>
            <li>Baik</li>
            <li>Sangat Baik</li>
        </ol>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Komponen Penilaian</th>
                        <th>Nilai (Range 1-5)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Komponen 1</td>
                        <td><input type="number" id="nilai" name="nilai" min="1" max="5"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Komponen 2</td>
                        <td><input type="number" id="nilai" name="nilai" min="1" max="5"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Komponen 3</td>
                        <td><input type="number" id="nilai" name="nilai" min="1" max="5"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Komponen 4</td>
                        <td><input type="number" id="nilai" name="nilai" min="1" max="5"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Komponen 5</td>
                        <td><input type="number" id="nilai" name="nilai" min="1" max="5"></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Komponen 6</td>
                        <td><input type="number" id="nilai" name="nilai" min="1" max="5"></td>
                    </tr>
                </tbody>
            </table>
            <p>Catatan Revisi: </p>
            <textarea name="catatanRevisi" id="catatanRevisi" cols="150" rows="10"></textarea>
    </div>
@endsection --}}

@section('content')
<div class="container">
    <h2>{{ $isEdit ? 'Edit Nilai Sidang TA' : 'Isi Nilai Sidang TA' }}</h2>
    <form action="{{ $isEdit ? route('dosen.updateNilaiSidang', $jadwal->id_jadwal) : route('dosen.submitNilaiSidang', $jadwal->id_jadwal) }}" method="POST">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <!-- Tabel Penilaian Sebagai Penguji -->
        {{-- <h4>Penilaian Sebagai Penguji</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Komponen Penilaian</th>
                    @foreach(range(1, 5) as $range)
                        <th>{{ $range }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($komponenPenguji as $index => $komponen)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $komponen }}</td>
                    @foreach(range(1, 5) as $range)
                    <td>
                        <input type="radio" name="penguji[{{ $index }}]" value="{{ $range }}" 
                        @if(isset($nilaiPenguji[$index]) && $nilaiPenguji[$index] == $range) checked @endif required>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tabel Penilaian Sebagai Pembimbing -->
        @if($isPembimbing)
        <h4>Penilaian Sebagai Pembimbing</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Komponen Penilaian</th>
                    @foreach(range(1, 5) as $range)
                        <th>{{ $range }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($komponenPembimbing as $index => $komponen)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $komponen }}</td>
                    @foreach(range(1, 5) as $range)
                    <td>
                        <input type="radio" name="pembimbing[{{ $index }}]" value="{{ $range }}" 
                        @if(isset($nilaiPembimbing[$index]) && $nilaiPembimbing[$index] == $range) checked @endif required>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif --}}

        
        <h4>Penilaian Sebagai Penguji</h4>
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
                    <td>Pendahuluan</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><h5>Pendahuluan - Rumusan Masalah</h5>
                        <p>Rumusan masalah jelas dan terarah</p>
                        <p>Range nilai 1 -5. Nilai 1 berarti rumusan masalah tersebut sangat tidak jelas dan terarah.</p>
                        <p>Nilai 5 berati rumusan masalahnya sangat jelas dan terarah</p>
                    </td>
                    <td><input type="radio" name="p1" value="1" @if(isset($penguji->p1) && $penguji->p1 == 1) checked @endif required></td>
                    <td><input type="radio" name="p1" value="2" @if(isset($penguji->p1) && $penguji->p1 == 2) checked @endif required></td>
                    <td><input type="radio" name="p1" value="3" @if(isset($penguji->p1) && $penguji->p1 == 3) checked @endif required></td>
                    <td><input type="radio" name="p1" value="4" @if(isset($penguji->p1) && $penguji->p1 == 4) checked @endif required></td>
                    <td><input type="radio" name="p1" value="5" @if(isset($penguji->p1) && $penguji->p1 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pendahuluan - Tujuan Penelitian
                        <p>Tujuan penelitian dijabarkan dengan jelas</p>
                        <p>Range nilai 1 -5. Nilai 1 berarti sangat kurang dijabarkan dengan jelas.</p>
                        <p>Nilai 5 berati tujuan penelitan dijabarkan dengan sangat jelas</p>
                    </td>
                    <td><input type="radio" name="p2" value="1" @if(isset($penguji->p2) && $penguji->p2 == 1) checked @endif required></td>
                    <td><input type="radio" name="p2" value="2" @if(isset($penguji->p2) && $penguji->p2 == 2) checked @endif required></td>
                    <td><input type="radio" name="p2" value="3" @if(isset($penguji->p2) && $penguji->p2 == 3) checked @endif required></td>
                    <td><input type="radio" name="p2" value="4" @if(isset($penguji->p2) && $penguji->p2 == 4) checked @endif required></td>
                    <td><input type="radio" name="p2" value="5" @if(isset($penguji->p2) && $penguji->p2 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pendahuluan - Kontribusi Penelitian
                        <p>Kontribusi penelitian dijabarkan dengan jelas</p>
                        <p>Range nilai 1 -5. Nilai 1 berarti kontribusi penelitiannya dijabarkan dengan sangat kurang.</p>
                        <p>Nilai 5 berati kontribusi penelitian dijabarkan dengan sangat jelas</p>
                    </td>
                    <td><input type="radio" name="p3" value="1" @if(isset($penguji->p3) && $penguji->p3 == 1) checked @endif required></td>
                    <td><input type="radio" name="p3" value="2" @if(isset($penguji->p3) && $penguji->p3 == 2) checked @endif required></td>
                    <td><input type="radio" name="p3" value="3" @if(isset($penguji->p3) && $penguji->p3 == 3) checked @endif required></td>
                    <td><input type="radio" name="p3" value="4" @if(isset($penguji->p3) && $penguji->p3 == 4) checked @endif required></td>
                    <td><input type="radio" name="p3" value="5" @if(isset($penguji->p3) && $penguji->p3 == 5) checked @endif required></td>
                </tr>
              
                <tr>
                    <td>4</td>
                    <td>Kajian Teoritis - Relevansi dengan Topik yang Diteliti
                        <p>Adanya relevansi penelitian tugas akhir mahasiswa dengan topik yang diteliti</p>
                        {{-- <p>Rumusan masalah jelas dan terarah</p> --}}
                        <p>Range nilai 1 -5. Nilai 1 berarti topik sangat tidak relevan</p>
                        <p>Nilai 5 berati topik sangat relevan</p>
                    </td>
                    <td><input type="radio" name="kt1" value="1" @if(isset($penguji->kt1) && $penguji->kt1 == 1) checked @endif required></td>
                    <td><input type="radio" name="kt1" value="2" @if(isset($penguji->kt1) && $penguji->kt1 == 2) checked @endif required></td>
                    <td><input type="radio" name="kt1" value="3" @if(isset($penguji->kt1) && $penguji->kt1 == 3) checked @endif required></td>
                    <td><input type="radio" name="kt1" value="4" @if(isset($penguji->kt1) && $penguji->kt1 == 4) checked @endif required></td>
                    <td><input type="radio" name="kt1" value="5" @if(isset($penguji->kt1) && $penguji->kt1 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Kajian Teoritis - Daftar Pustaka Terkini
                        <p>Pengecekan kemutakhiran dan keterkinian daftar pustaka</p>
                        <p>Range nilai 1 -5. Nilai 1 berarti ada lebih dari 50% sumber pada daftar pustaka yang tidak terkini (lebih dari 10 tahun)</p>
                        <p>Nilai 5 berati ada kurang dari 10% sumber pada daftar pustaka yang tidak terkini (lebih dari 10 tahun)</p>
                    </td>
                    <td><input type="radio" name="kt2" value="1" @if(isset($penguji->kt2) && $penguji->kt2 == 1) checked @endif required></td>
                    <td><input type="radio" name="kt2" value="2" @if(isset($penguji->kt2) && $penguji->kt2 == 2) checked @endif required></td>
                    <td><input type="radio" name="kt2" value="3" @if(isset($penguji->kt2) && $penguji->kt2 == 3) checked @endif required></td>
                    <td><input type="radio" name="kt2" value="4" @if(isset($penguji->kt2) && $penguji->kt2 == 4) checked @endif required></td>
                    <td><input type="radio" name="kt2" value="5" @if(isset($penguji->kt2) && $penguji->kt2 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Kajian Teoritis - Relevansi Acuan Daftar Pustaka</td>
                    <td><input type="radio" name="kt3" value="1" @if(isset($penguji->kt3) && $penguji->kt3 == 1) checked @endif required></td>
                    <td><input type="radio" name="kt3" value="2" @if(isset($penguji->kt3) && $penguji->kt3 == 2) checked @endif required></td>
                    <td><input type="radio" name="kt3" value="3" @if(isset($penguji->kt3) && $penguji->kt3 == 3) checked @endif required></td>
                    <td><input type="radio" name="kt3" value="4" @if(isset($penguji->kt3) && $penguji->kt3 == 4) checked @endif required></td>
                    <td><input type="radio" name="kt3" value="5" @if(isset($penguji->kt3) && $penguji->kt3 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Metode Penelitian - Kesesuaian dengan Masalah</td>
                    <td><input type="radio" name="ml1" value="1" @if(isset($penguji->ml1) && $penguji->ml1 == 1) checked @endif required></td>
                    <td><input type="radio" name="ml1" value="2" @if(isset($penguji->ml1) && $penguji->ml1 == 2) checked @endif required></td>
                    <td><input type="radio" name="ml1" value="3" @if(isset($penguji->ml1) && $penguji->ml1 == 3) checked @endif required></td>
                    <td><input type="radio" name="ml1" value="4" @if(isset($penguji->ml1) && $penguji->ml1 == 4) checked @endif required></td>
                    <td><input type="radio" name="ml1" value="5" @if(isset($penguji->ml1) && $penguji->ml1 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Metode Penelitian - Ketepatan Rancangan/Model Penelitian</td>
                    <td><input type="radio" name="ml2" value="1" @if(isset($penguji->ml2) && $penguji->ml2 == 1) checked @endif required></td>
                    <td><input type="radio" name="ml2" value="2" @if(isset($penguji->ml2) && $penguji->ml2 == 2) checked @endif required></td>
                    <td><input type="radio" name="ml2" value="3" @if(isset($penguji->ml2) && $penguji->ml2 == 3) checked @endif required></td>
                    <td><input type="radio" name="ml2" value="4" @if(isset($penguji->ml2) && $penguji->ml2 == 4) checked @endif required></td>
                    <td><input type="radio" name="ml2" value="5" @if(isset($penguji->ml2) && $penguji->ml2 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Metode Penelitian - Ketepatan Instrumen</td>
                    <td><input type="radio" name="ml3" value="1" @if(isset($penguji->ml3) && $penguji->ml3 == 1) checked @endif required></td>
                    <td><input type="radio" name="ml3" value="2" @if(isset($penguji->ml3) && $penguji->ml3 == 2) checked @endif required></td>
                    <td><input type="radio" name="ml3" value="3" @if(isset($penguji->ml3) && $penguji->ml3 == 3) checked @endif required></td>
                    <td><input type="radio" name="ml3" value="4" @if(isset($penguji->ml3) && $penguji->ml3 == 4) checked @endif required></td>
                    <td><input type="radio" name="ml3" value="5" @if(isset($penguji->ml3) && $penguji->ml3 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Metode Penelitian - Ketepatan dan Ketajaman Analisis</td>
                    <td><input type="radio" name="ml4" value="1" @if(isset($penguji->ml4) && $penguji->ml4 == 1) checked @endif required></td>
                    <td><input type="radio" name="ml4" value="2" @if(isset($penguji->ml4) && $penguji->ml4 == 2) checked @endif required></td>
                    <td><input type="radio" name="ml4" value="3" @if(isset($penguji->ml4) && $penguji->ml4 == 3) checked @endif required></td>
                    <td><input type="radio" name="ml4" value="4" @if(isset($penguji->ml4) && $penguji->ml4 == 4) checked @endif required></td>
                    <td><input type="radio" name="ml4" value="5" @if(isset($penguji->ml4) && $penguji->ml4 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Hasil Penelitian - Manfaat dan Kontribusi Bagi Pengembangan Ilmu</td>
                    <td><input type="radio" name="h1" value="1" @if(isset($penguji->h1) && $penguji->h1 == 1) checked @endif required></td>
                    <td><input type="radio" name="h1" value="2" @if(isset($penguji->h1) && $penguji->h1 == 2) checked @endif required></td>
                    <td><input type="radio" name="h1" value="3" @if(isset($penguji->h1) && $penguji->h1 == 3) checked @endif required></td>
                    <td><input type="radio" name="h1" value="4" @if(isset($penguji->h1) && $penguji->h1 == 4) checked @endif required></td>
                    <td><input type="radio" name="h1" value="5" @if(isset($penguji->h1) && $penguji->h1 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Hasil Penelitian - Kesesuaian dengan Tujuan Penelitian</td>
                    <td><input type="radio" name="h2" value="1" @if(isset($penguji->h2) && $penguji->h2 == 1) checked @endif required></td>
                    <td><input type="radio" name="h2" value="2" @if(isset($penguji->h2) && $penguji->h2 == 2) checked @endif required></td>
                    <td><input type="radio" name="h2" value="3" @if(isset($penguji->h2) && $penguji->h2 == 3) checked @endif required></td>
                    <td><input type="radio" name="h2" value="4" @if(isset($penguji->h2) && $penguji->h2 == 4) checked @endif required></td>
                    <td><input type="radio" name="h2" value="5" @if(isset($penguji->h2) && $penguji->h2 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Hasil Penelitian - Kedalaman Pembahasan</td>
                    <td><input type="radio" name="h3" value="1" @if(isset($penguji->h3) && $penguji->h3 == 1) checked @endif required></td>
                    <td><input type="radio" name="h3" value="2" @if(isset($penguji->h3) && $penguji->h3 == 2) checked @endif required></td>
                    <td><input type="radio" name="h3" value="3" @if(isset($penguji->h3) && $penguji->h3 == 3) checked @endif required></td>
                    <td><input type="radio" name="h3" value="4" @if(isset($penguji->h3) && $penguji->h3 == 4) checked @endif required></td>
                    <td><input type="radio" name="h3" value="5" @if(isset($penguji->h3) && $penguji->h3 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Hasil Penelitian - Kadar Keaslian Tulisan</td>
                    <td><input type="radio" name="h4" value="1" @if(isset($penguji->h4) && $penguji->h4 == 1) checked @endif required></td>
                    <td><input type="radio" name="h4" value="2" @if(isset($penguji->h4) && $penguji->h4 == 2) checked @endif required></td>
                    <td><input type="radio" name="h4" value="3" @if(isset($penguji->h4) && $penguji->h4 == 3) checked @endif required></td>
                    <td><input type="radio" name="h4" value="4" @if(isset($penguji->h4) && $penguji->h4 == 4) checked @endif required></td>
                    <td><input type="radio" name="h4" value="5" @if(isset($penguji->h4) && $penguji->h4 == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>Sikap Ilmiah - Wawasan Bidang Ilmu</td>
                    <td><input type="radio" name="wbi" value="1" @if(isset($penguji->wbi) && $penguji->wbi == 1) checked @endif required></td>
                    <td><input type="radio" name="wbi" value="2" @if(isset($penguji->wbi) && $penguji->wbi == 2) checked @endif required></td>
                    <td><input type="radio" name="wbi" value="3" @if(isset($penguji->wbi) && $penguji->wbi == 3) checked @endif required></td>
                    <td><input type="radio" name="wbi" value="4" @if(isset($penguji->wbi) && $penguji->wbi == 4) checked @endif required></td>
                    <td><input type="radio" name="wbi" value="5" @if(isset($penguji->wbi) && $penguji->wbi == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>Sikap Ilmiah - Kemampuan Presentasi</td>
                    <td><input type="radio" name="kp" value="1" @if(isset($penguji->kp) && $penguji->kp == 1) checked @endif required></td>
                    <td><input type="radio" name="kp" value="2" @if(isset($penguji->kp) && $penguji->kp == 2) checked @endif required></td>
                    <td><input type="radio" name="kp" value="3" @if(isset($penguji->kp) && $penguji->kp == 3) checked @endif required></td>
                    <td><input type="radio" name="kp" value="4" @if(isset($penguji->kp) && $penguji->kp == 4) checked @endif required></td>
                    <td><input type="radio" name="kp" value="5" @if(isset($penguji->kp) && $penguji->kp == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>Sikap Ilmiah - Ketepatan Jawaban</td>
                    <td><input type="radio" name="tepatJ" value="1" @if(isset($penguji->tepatJ) && $penguji->tepatJ == 1) checked @endif required></td>
                    <td><input type="radio" name="tepatJ" value="2" @if(isset($penguji->tepatJ) && $penguji->tepatJ == 2) checked @endif required></td>
                    <td><input type="radio" name="tepatJ" value="3" @if(isset($penguji->tepatJ) && $penguji->tepatJ == 3) checked @endif required></td>
                    <td><input type="radio" name="tepatJ" value="4" @if(isset($penguji->tepatJ) && $penguji->tepatJ == 4) checked @endif required></td>
                    <td><input type="radio" name="tepatJ" value="5" @if(isset($penguji->tepatJ) && $penguji->tepatJ == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>Sikap Ilmiah - Kelancaran Jawaban</td>
                    <td><input type="radio" name="lancarJ" value="1" @if(isset($penguji->lancarJ) && $penguji->lancarJ == 1) checked @endif required></td>
                    <td><input type="radio" name="lancarJ" value="2" @if(isset($penguji->lancarJ) && $penguji->lancarJ == 2) checked @endif required></td>
                    <td><input type="radio" name="lancarJ" value="3" @if(isset($penguji->lancarJ) && $penguji->lancarJ == 3) checked @endif required></td>
                    <td><input type="radio" name="lancarJ" value="4" @if(isset($penguji->lancarJ) && $penguji->lancarJ == 4) checked @endif required></td>
                    <td><input type="radio" name="lancarJ" value="5" @if(isset($penguji->lancarJ) && $penguji->lancarJ == 5) checked @endif required></td>
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
                    <td><input type="radio" name="nilai_tata_tulis" value="1" @if(isset($nilaiSidangPembimbing->nilai_tata_tulis) && $nilaiSidangPembimbing->nilai_tata_tulis == 1) checked @endif required></td>
                    <td><input type="radio" name="nilai_tata_tulis" value="2" @if(isset($nilaiSidangPembimbing->nilai_tata_tulis) && $nilaiSidangPembimbing->nilai_tata_tulis == 2) checked @endif required></td>
                    <td><input type="radio" name="nilai_tata_tulis" value="3" @if(isset($nilaiSidangPembimbing->nilai_tata_tulis) && $nilaiSidangPembimbing->nilai_tata_tulis == 3) checked @endif required></td>
                    <td><input type="radio" name="nilai_tata_tulis" value="4" @if(isset($nilaiSidangPembimbing->nilai_tata_tulis) && $nilaiSidangPembimbing->nilai_tata_tulis == 4) checked @endif required></td>
                    <td><input type="radio" name="nilai_tata_tulis" value="5" @if(isset($nilaiSidangPembimbing->nilai_tata_tulis) && $nilaiSidangPembimbing->nilai_tata_tulis == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Keaktifan</td>
                    <td><input type="radio" name="nilai_keaktifan" value="1" @if(isset($nilaiSidangPembimbing->nilai_keaktifan) && $nilaiSidangPembimbing->nilai_keaktifan == 1) checked @endif required></td>
                    <td><input type="radio" name="nilai_keaktifan" value="2" @if(isset($nilaiSidangPembimbing->nilai_keaktifan) && $nilaiSidangPembimbing->nilai_keaktifan == 2) checked @endif required></td>
                    <td><input type="radio" name="nilai_keaktifan" value="3" @if(isset($nilaiSidangPembimbing->nilai_keaktifan) && $nilaiSidangPembimbing->nilai_keaktifan == 3) checked @endif required></td>
                    <td><input type="radio" name="nilai_keaktifan" value="4" @if(isset($nilaiSidangPembimbing->nilai_keaktifan) && $nilaiSidangPembimbing->nilai_keaktifan == 4) checked @endif required></td>
                    <td><input type="radio" name="nilai_keaktifan" value="5" @if(isset($nilaiSidangPembimbing->nilai_keaktifan) && $nilaiSidangPembimbing->nilai_keaktifan == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Penguasaan Materi</td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="1" @if(isset($nilaiSidangPembimbing->nilai_penguasaan_materi) && $nilaiSidangPembimbing->nilai_penguasaan_materi == 1) checked @endif required></td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="2" @if(isset($nilaiSidangPembimbing->nilai_penguasaan_materi) && $nilaiSidangPembimbing->nilai_penguasaan_materi == 2) checked @endif required></td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="3" @if(isset($nilaiSidangPembimbing->nilai_penguasaan_materi) && $nilaiSidangPembimbing->nilai_penguasaan_materi == 3) checked @endif required></td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="4" @if(isset($nilaiSidangPembimbing->nilai_penguasaan_materi) && $nilaiSidangPembimbing->nilai_penguasaan_materi == 4) checked @endif required></td>
                    <td><input type="radio" name="nilai_penguasaan_materi" value="5" @if(isset($nilaiSidangPembimbing->nilai_penguasaan_materi) && $nilaiSidangPembimbing->nilai_penguasaan_materi == 5) checked @endif required></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Penyelesaian Masalah</td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="1" @if(isset($nilaiSidangPembimbing->nilai_penyelesaian_masalah) && $nilaiSidangPembimbing->nilai_penyelesaian_masalah == 1) checked @endif required></td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="2" @if(isset($nilaiSidangPembimbing->nilai_penyelesaian_masalah) && $nilaiSidangPembimbing->nilai_penyelesaian_masalah == 2) checked @endif required></td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="3" @if(isset($nilaiSidangPembimbing->nilai_penyelesaian_masalah) && $nilaiSidangPembimbing->nilai_penyelesaian_masalah == 3) checked @endif required></td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="4" @if(isset($nilaiSidangPembimbing->nilai_penyelesaian_masalah) && $nilaiSidangPembimbing->nilai_penyelesaian_masalah == 4) checked @endif required></td>
                    <td><input type="radio" name="nilai_penyelesaian_masalah" value="5" @if(isset($nilaiSidangPembimbing->nilai_penyelesaian_masalah) && $nilaiSidangPembimbing->nilai_penyelesaian_masalah == 5) checked @endif required></td>
                </tr>
            </tbody>
        </table>
        @endif

        <div class="form-group">
            <label for="catatan_revisi">Catatan Revisi</label>
            <textarea name="catatan_revisi" id="catatan_revisi" rows="3" class="form-control">{{ $penguji->catatan_revisi }}</textarea>
        </div>










        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection