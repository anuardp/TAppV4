@extends('layouts.admin-home')

@section('content')
    <div class="container">
        <h2>Input Data Dosen</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('admin.dosen.store') }}" method="POST">
            @csrf
            <input type="text" class="form-control mb-3" name="nidn" placeholder="NIDN" required>
            <input type="text" class="form-control mb-3" name="nama_dosen" placeholder="Nama Dosen" required>
            <input type="number" class="form-control mb-3" name="tahun_mulai_mengajar" placeholder="Tahun Mulai Mengajar" required>
            <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
            <input type="text" class="form-control mb-3" name="nomor_telepon" placeholder="Nomor Telepon" required>
            <textarea class="form-control mb-3" name="alamat" placeholder="Alamat"></textarea>
            <input type="text" class="form-control mb-3" name="jabatan_fungsional" placeholder="Jabatan Fungsional" required>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection