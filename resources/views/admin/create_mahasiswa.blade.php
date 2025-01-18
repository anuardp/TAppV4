@extends('layouts.admin-home')

@section('content')
    <div class="container">
        <h2>Input Data Mahasiswa</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
            @csrf
            <input type="text" class="form-control mb-3" name="nim" placeholder="NIM" required>
            <input type="text" class="form-control mb-3" name="nama_mahasiswa" placeholder="Nama Mahasiswa" required>
            <input type="number" class="form-control mb-3" name="angkatan" placeholder="Angkatan" required>
            <input type="text" class="form-control mb-3" name="fakultas" placeholder="Fakultas" required>
            <input type="text" class="form-control mb-3" name="prodi" placeholder="Program Studi" required>
            <textarea class="form-control mb-3" name="judul" placeholder="Judul"></textarea>
            <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
            <input type="text" class="form-control mb-3" name="nomor_telepon" placeholder="Nomor Telepon" required>
            <textarea class="form-control mb-3" name="alamat" placeholder="Alamat"></textarea>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection