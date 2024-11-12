@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Pendaftar PPDB</h1>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('pendaftars.create') }}" class="btn btn-primary">Tambah Pendaftar</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
    <!-- Display success message if available -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-hover table-striped">
        <thead class="table-primary">
            <tr>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftars as $pendaftar)
            <tr>
                <td>{{ $pendaftar->nama_lengkap }}</td>
                <td>{{ $pendaftar->tanggal_lahir }}</td>
                <td>{{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $pendaftar->alamat }}</td>
                <td>{{ $pendaftar->email }}</td>
                <td>{{ $pendaftar->no_hp }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('pendaftars.edit', $pendaftar) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pendaftars.destroy', $pendaftar) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="d-flex justify-content-center">
        {{ $pendaftars->links() }}
    </div>
</div>
@endsection
