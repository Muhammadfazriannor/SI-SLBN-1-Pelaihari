@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pendaftar</h1>

    <p><strong>Nama Lengkap:</strong> {{ $pendaftar->nama_lengkap }}</p>
    <p><strong>Tanggal Lahir:</strong> {{ $pendaftar->tanggal_lahir }}</p>
    <p><strong>Jenis Kelamin:</strong> {{ $pendaftar->jenis_kelamin }}</p>
    <p><strong>Alamat:</strong> {{ $pendaftar->alamat }}</p>
    <p><strong>Email:</strong> {{ $pendaftar->email }}</p>
    <p><strong>No HP:</strong> {{ $pendaftar->no_hp }}</p>
    @if($pendaftar->foto)
        <p><strong>Foto:</strong> <img src="{{ Storage::url($pendaftar->foto) }}" alt="Foto Pendaftar" width="150"></p>
    @endif
    <a href="{{ route('pendaftars.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
