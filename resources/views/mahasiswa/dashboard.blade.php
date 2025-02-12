@extends('layouts.mahasiswa-home')

@section('content')
<div class="container">
    <h2>Home Mahasiswa</h2>
    <div class="alert alert-info">
        <h4>Pengumuman:</h4>
        <p>{{ $pengumuman }}</p>
    </div>
</div>
@endsection