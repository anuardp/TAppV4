@extends('layouts.admin-home')

@section('content')
    <div class="container">
        <h2>Edit Data Mahasiswa</h2>
        <form  action="{{ route('admin.mahasiswa.update', $mhs->id_mahasiswa) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- <input type="hidden" name="id_mahasiswa" value="{{ $mhs->id_mahasiswa }}"> --}}

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control mb-3" name="nim" value="{{ $mhs->nim }}" required>
            </div>
            <div class="mb-3">
                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control mb-3" name="nama_mahasiswa" value="{{ $mhs->nama_mahasiswa }}" required>
            </div>
            <div class="mb-3">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input type="number" class="form-control mb-3" name="angkatan" value="{{ $mhs->angkatan }}" required>
            </div>
            <div class="mb-3">
                <label for="fakultas" class="form-label">Fakultas</label>
                <input type="text" class="form-control mb-3" name="fakultas" value="{{ $mhs->fakultas }}" required>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control mb-3" name="prodi" value="{{ $mhs->prodi }}" required>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <textarea class="form-control mb-3" name="judul">{{ $mhs->judul }}</textarea>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control mb-3" name="email" value="{{ $mhs->email }}" required>
            </div>
            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control mb-3" name="nomor_telepon" value="{{ $mhs->nomor_telepon }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control mb-3" name="alamat" value="{{ $mhs->alamat }}">{{ $mhs->alamat }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('daftar.mahasiswa') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection