@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h1 class="text-center mb-4">Tambah Pendaftar</h1>

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

                    <form action="{{ route('pendaftars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Lengkap Field -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}" required>
                            
                            @error('nama_lengkap')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir Field -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            
                            @error('tanggal_lahir')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin Field -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            
                            @error('jenis_kelamin')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat Field -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                            
                            @error('alamat')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="contoh@example.com" value="{{ old('email') }}" required>
                            
                            @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- No HP Field -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">No HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="Masukkan nomor HP aktif" value="{{ old('no_hp') }}" required>
                            
                            @error('no_hp')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto Berkas ABK Field -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Foto Berkas ABK</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                            
                            @error('foto')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-md btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
