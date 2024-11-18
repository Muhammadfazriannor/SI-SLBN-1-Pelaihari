@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <!-- Tombol kembali ke dashboard -->
                    <a href="{{ route('dashboard') }}" class="btn btn-md btn-secondary mb-3">KEMBALI KE DASHBOARD</a>

                    <!-- Tombol untuk menambah pendaftar -->
                    <a href="{{ route('pendaftars.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PENDAFTAR</a>

                    <!-- Display success or error message -->
                    @if(session('success') || session('error'))
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
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

                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th style="width: 20%">Aksi</th>
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
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('pendaftars.edit', $pendaftar) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('pendaftars.destroy', $pendaftar) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini?')">HAPUS</button>
                                            </form>
                                            <!-- Tombol Lihat -->
                                            <a href="{{ route('pendaftars.show', $pendaftar) }}" class="btn btn-sm btn-dark">LIHAT</a>
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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
