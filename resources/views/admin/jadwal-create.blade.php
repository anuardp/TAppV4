@extends('layouts.admin-home')

@section('content')
<div class="container">
    <h2>Buat Jadwal Sidang Baru</h2>
    <form action="{{ route('admin.jadwal.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_sidang" class="form-label">Tanggal Sidang</label>
            <input type="date" name="tanggal_sidang" id="tanggal_sidang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="waktu_sidang" class="form-label">Waktu Sidang</label>
            <input type="time" name="waktu_sidang" id="waktu_sidang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nidn_pembimbing" class="form-label">NIDN Pembimbing</label>
            <input type="text" name="nidn_pembimbing" id="nidn_pembimbing" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nidn_penguji1" class="form-label">NIDN Penguji 1</label>
            <input type="text" name="nidn_penguji1" id="nidn_penguji1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nidn_penguji2" class="form-label">NIDN Penguji 2</label>
            <input type="text" name="nidn_penguji2" id="nidn_penguji2" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection