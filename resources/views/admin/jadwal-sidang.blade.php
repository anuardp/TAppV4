@extends('layouts.admin-home')
    
@section('content')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="container">
        <h2>Daftar Jadwal Sidang Mahasiswa</h2>
        @if($jadwalSidang->isEmpty())
            <p>Tidak ada jadwal sidang.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul TA</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Pembimbing</th>
                        <th>Penguji 1</th>
                        <th>Penguji 2</th>
                        <th>Status Sidang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwalSidang as $index => $jadwal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jadwal->nim }}</td>
                        <td>{{ $jadwal->nama_mahasiswa }}</td>
                        <td>{{ $jadwal->judul_ta }}</td>
                        <td>{{ $jadwal->tanggal_sidang }}</td>
                        <td>{{ $jadwal->waktu_sidang }}</td>
                        <td>{{ $jadwal->nama_pembimbing }}</td>
                        <td>{{ $jadwal->nama_penguji1 }}</td>
                        <td>{{ $jadwal->nama_penguji2 }}</td>
                        <td>{{ ucfirst($jadwal->status_sidang) }}</td>
                        <td>
                            @if($jadwal->status_sidang === 'belum')
                            <form action="{{ route('jadwal-sidang.update-status', $jadwal->id_jadwal) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Tandai Sudah Sidang</button>
                            </form>
                            @else
                            <button class="btn btn-secondary" disabled>Sudah Sidang</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

