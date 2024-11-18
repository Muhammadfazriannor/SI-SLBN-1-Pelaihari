@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Edit Pendaftar</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pendaftars.update', $pendaftar) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $pendaftar->nama_lengkap }}" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pendaftar->tanggal_lahir }}" required>
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L" {{ $pendaftar->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $pendaftar->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ $pendaftar->alamat }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $pendaftar->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $pendaftar->no_hp }}" required>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto berkas ABK (kosongkan jika tidak ingin mengganti)</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
