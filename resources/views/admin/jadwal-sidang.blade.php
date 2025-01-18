@extends('layouts.admin-home')
    
@section('content')
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
                        <td>
                            <form action="{{ route('admin.jadwal.updateStatus', $jadwal->id_jadwal) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button 
                                    type="submit" 
                                    class="btn btn-sm {{ $jadwal->status_sidang ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $jadwal->status_sidang ? '✔' : 'Belum Selesai' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection