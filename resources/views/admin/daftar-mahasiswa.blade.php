@extends('layouts.admin-home')

@section('content')
    <div class="container mt-4">
        <h2>Daftar Mahasiswa</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Angkatan</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->nama_mahasiswa }}</td>
                    <td>{{ $mhs->angkatan }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td>{{ $mhs->nomor_telepon }}</td>
                    <td>{{ $mhs->alamat }}</td>
                    <td>
                        <a href="{{ route('admin.mahasiswa.edit', $mhs->id_mahasiswa) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection