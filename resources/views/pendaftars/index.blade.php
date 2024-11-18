@extends('layouts.app')

@section('content')
<div class="container">
<<<<<<< HEAD
    <h1 class="my-4 text-center">Pendaftar PPDB</h1>
    <div class="d-flex mb-3">
        <!-- Tombol untuk menambah pendaftar -->
        <a href="{{ route('pendaftars.create') }}" class="btn btn-primary">Tambah Pendaftar</a>
        
        <!-- Tombol kembali ke dashboard tanpa jarak -->
        <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">Kembali ke Dashboard</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <!-- Display success message if available -->
                @if(session('success'))
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        // Message with sweetalert
                        @if(session('success'))
                            Swal.fire({
                                icon: "success",
                                title: "BERHASIL",
                                text: "{{ session('success') }}",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        @elseif(session('error'))
                            Swal.fire({
                                icon: "error",
                                title: "GAGAL!",
                                text: "{{ session('error') }}",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        @endif
                    </script>
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
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('pendaftars.edit', $pendaftar) }}" class="btn btn-sm btn-warning">Edit</a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('pendaftars.destroy', $pendaftar) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini?')">Hapus</button>
                                    </form>
                                    
                                    <!-- Tombol Lihat -->
                                    <a href="{{ route('pendaftars.show', $pendaftar) }}" class="btn btn-sm btn-info">Lihat</a>
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
        </div>
    </div>
    
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
>>>>>>> a628b5d078c51e2cf77b451859dee30452e4f384
</div>

@endsection

