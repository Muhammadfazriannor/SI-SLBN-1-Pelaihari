@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Tambah Pendaftar</h1>

    <!-- Tampilkan Error, jika ada -->
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa masalah dengan input Anda:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pendaftars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="contoh@example.com" required>
                </div>
                <div class="form-group mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="Masukkan nomor HP aktif" required>
                </div>
                <div class="form-group mb-3">
                    <label for="foto" class="form-label">Foto Berkas ABK</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
