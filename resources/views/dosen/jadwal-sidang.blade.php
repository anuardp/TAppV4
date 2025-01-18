@extends('layouts.dosen-home')

@section('content')
    <div class="container">
        <h2>Jadwal Sidang Saya</h2>
        @if($jadwalSidang->isEmpty())
            <p>Tidak ada jadwal sidang.</p>
        @else
            {{-- <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal Sidang</th>
                        <th>Waktu Sidang</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwalSidang as $jadwal)
                    <tr>
                        <td>{{ $jadwal->tanggal_sidang }}</td>
                        <td>{{ $jadwal->waktu_sidang }}</td>
                        <td>{{ $jadwal->nama_mahasiswa }}</td>
                        <td>{{ $jadwal->nim }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table> --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                        <th>Finalisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwalSidang as $index => $jadwal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jadwal->nim }}</td>
                        <td>{{ $jadwal->nama_mahasiswa }}</td>
                        <td>{{ $jadwal->tanggal_sidang }}</td>
                        <td>{{ $jadwal->waktu_sidang }}</td>
                        <td>
                            <a href="{{ route('dosen.jadwal.isiNilai', $jadwal->id_jadwal) }}" class="btn btn-primary btn-sm">
                                Isi
                            </a>
                            <a href="{{ route('dosen.jadwal.editNilai', $jadwal->id_jadwal) }}" 
                               class="btn btn-warning btn-sm {{ is_null($jadwal->nilai_pembimbing) ? 'disabled' : '' }}">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('dosen.jadwal.finalisasiNilai', $jadwal->id_jadwal) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="btn btn-success btn-sm {{ $jadwal->is_final ? 'disabled' : '' }}">
                                    {{ $jadwal->is_final ? '✔ Final' : 'Finalisasi' }}
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