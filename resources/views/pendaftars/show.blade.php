@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Detail Pendaftar</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($pendaftar->foto)
                        <img src="{{ Storage::url($pendaftar->foto) }}" alt="Foto Pendaftar" class="img-fluid rounded mb-3" style="max-width: 150px;">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Foto Tidak Tersedia" class="img-fluid rounded mb-3">
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Nama Lengkap:</strong> {{ $pendaftar->nama_lengkap }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $pendaftar->tanggal_lahir }}</p>
                    <p><strong>Jenis Kel<div class="container">
    <h1 class="text-center my-4">Detail Pendaftar</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($pendaftar->foto)
                        <img src="{{ Storage::url($pendaftar->foto) }}" alt="Foto Pendaftar" class="img-fluid rounded mb-3" style="max-width: 150px;">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Foto Tidak Tersedia" class="img-fluid rounded mb-3">
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Nama Lengkap:</strong> {{ $pendaftar->nama_lengkap }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ date('d-m-Y', strtotime($pendaftar->tanggal_lahir)) }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    <p><strong>Alamat:</strong> {{ $pendaftar->alamat }}</p>
                    <p><strong>Email:</strong> {{ $pendaftar->email }}</p>
                    <p><strong>No HP:</strong> {{ $pendaftar->no_hp }}</p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('pendaftars.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div></strong> {{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    <p><strong>Alamat:</strong> {{ $pendaftar->alamat }}</p>
                    <p><strong>Email:</strong> {{ $pendaftar->email }}</p>
                    <p><strong>No HP:</strong> {{ $pendaftar->no_hp }}</p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('pendaftars.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
