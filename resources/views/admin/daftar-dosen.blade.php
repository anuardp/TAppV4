@extends('layouts.admin-home')

@section('content')
    <div class="container mt-4">
        <h2>Daftar Dosen</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>NIDN</th>
                    <th>Nama Dosen</th>
                    <th>Tahun Mulai Mengajar</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Jabatan Fungsional</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dosen as $index => $dsn)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dsn->nidn }}</td>
                    <td>{{ $dsn->nama_dosen }}</td>
                    <td>{{ $dsn->tahun_mulai_mengajar }}</td>
                    <td>{{ $dsn->email }}</td>
                    <td>{{ $dsn->nomor_telepon }}</td>
                    <td>{{ $dsn->alamat }}</td>
                    <td>{{ $dsn->jabatan_fungsional }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection