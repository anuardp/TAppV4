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
{{-- <div class="container">
    <h2>{{ $isEdit ? 'Edit Nilai Sidang TA' : 'Isi Nilai Sidang TA' }}</h2>
    <form action="{{ $isEdit ? route('update-nilai-sidang', $jadwal->id) : route('store-nilai-sidang', $jadwal->id) }}" method="POST">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <!-- Tabel Penilaian Sebagai Penguji -->
        <h4>Penilaian Sebagai Penguji</h4>
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
        @endif

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div> --}}
<h2>{{ $isEdit ? 'Edit Nilai Sidang TA' : 'Isi Nilai Sidang TA' }}</h2>

<p>Nama Mahasiswa: {{ $jadwal->mahasiswa->nama_mahasiswa }}</p>
<p>NIM: {{ $jadwal->mahasiswa->nim }}</p>

<!-- Form untuk penilaian -->
<form method="POST" action="{{ $isEdit ? route('dosen.updateNilaiSidang', $jadwal->id_jadwal) : route('dosen.submitNilaiSidang', $jadwal->id_jadwal) }}">
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
            <label for="catatan_revisi_pembimbing">Catatan Revisi (Pembimbing):</label>
            <textarea name="catatan_revisi_pembimbing" id="catatan_revisi_pembimbing" rows="4">{{ $nilaiSidangPembimbing->catatan_revisi ?? '' }}</textarea>
        </div>
    @endif

    <!-- Tombol Submit -->
    <button type="submit">Simpan Nilai</button>
</form>
@endsection