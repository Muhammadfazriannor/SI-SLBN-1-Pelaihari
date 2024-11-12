@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pendaftar</h1>

    <form action="{{ route('pendaftars.update', $pendaftar) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ $pendaftar->nama_lengkap }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pendaftar->tanggal_lahir }}" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="L" {{ $pendaftar->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $pendaftar->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ $pendaftar->alamat }}</textarea>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $pendaftar->email }}" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pendaftar->no_hp }}" required>
        </div>
        <div class="form-group">
            <label for="foto">Foto berkas ABK (kosongkan jika tidak ingin mengganti)</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
