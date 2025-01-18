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
</div>
@endsection