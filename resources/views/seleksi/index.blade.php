@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hasil Seleksi</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seleksis as $key => $seleksi)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $seleksi->nama_lengkap }}</td>
                    <td>{{ $seleksi->jenis_kelamin }}</td>
                    <td>{{ $seleksi->tanggal_lahir }}</td>
                    <td>{{ $seleksi->alamat }}</td>
                    <td>{{ $seleksi->email }}</td>
                    <td>{{ $seleksi->no_hp }}</td>
                    <td>
                        @if ($seleksi->foto)
                            <img src="{{ asset('storage/' . $seleksi->foto) }}" alt="Foto" width="100">
                        @else
                            Tidak Ada Foto
                        @endif
                    </td>
                    <td>
                        @if ($seleksi->status == 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @elseif ($seleksi->status == 'tidak diterima')
                            <span class="badge bg-danger">Tidak Diterima</span>
                        @else
                            <span class="badge bg-warning">Lihat</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('seleksi.updateStatus', ['seleksi' => $seleksi->id, 'status' => 'diterima']) }}" class="btn btn-success btn-sm">Diterima</a>
                        <a href="{{ route('seleksi.updateStatus', ['seleksi' => $seleksi->id, 'status' => 'tidak diterima']) }}" class="btn btn-danger btn-sm">Tidak Diterima</a>
                        <a href="{{ route('seleksi.updateStatus', ['seleksi' => $seleksi->id, 'status' => 'lihat']) }}" class="btn btn-warning btn-sm">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
