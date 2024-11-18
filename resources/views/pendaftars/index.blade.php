@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pendaftar PPDB</h1>
    <a href="{{ route('pendaftars.create') }}" class="btn btn-primary">Tambah Pendaftar</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
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
                <td>{{ $pendaftar->jenis_kelamin }}</td>
                <td>{{ $pendaftar->alamat }}</td>
                <td>{{ $pendaftar->email }}</td>
                <td>{{ $pendaftar->no_hp }}</td>
                <td>
                    <a href="{{ route('pendaftars.edit', $pendaftar) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('pendaftars.destroy', $pendaftar) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pendaftars->links() }}
</div>

@endsection

