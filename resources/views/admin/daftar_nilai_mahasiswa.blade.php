@extends('layouts.admin-home')

@section('content')
    <div class="container mt-4">
        <h2>Daftar Nilai Tugas Akhir Mahasiswa</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Tugas Akhir</th>
                    <th>Nilai Pembimbing</th>
                    <th>Nilai Penguji 1</th>
                    <th>Nilai Penguji 2</th>
                    <th>Nilai Penguji 3</th>
                    <th>Nilai Akhir</th>
                </tr> 
            </thead>
            <tbody>
                @foreach($daftarNilaiMahasiswa as $index => $nilaiMhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $nilaiMhs->nim }}</td>
                    <td>{{ $nilaiMhs->nama_mahasiswa }}</td>
                    <td>{{ $nilaiMhs->judul_ta }}</td>
                    <td>{{ $nilaiMhs->nilai_pembimbing }}</td>
                    <td>{{ $nilaiMhs->nilai_penguji1 }}</td>
                    <td>{{ $nilaiMhs->nilai_penguji2 }}</td>
                    <td>{{ $nilaiMhs->nilai_penguji3 }}</td>
                    <td>{{ $nilaiMhs->nilai_akhir }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection