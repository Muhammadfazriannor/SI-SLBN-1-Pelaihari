@extends('layouts.app')

@section('content')
<div class="container mt-5"> <!-- Menambahkan margin atas -->
    <div class="d-flex mb-3">
        <!-- Tombol Kembali ke Dashboard dan Tambah Pendaftar berada di sebelah kiri -->
        <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">KEMBALI KE DASHBOARD</a>
        <a href="{{ route('pendaftars.create') }}" class="btn btn-success">TAMBAH PENDAFTAR</a>
    </div>
    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <!-- Menampilkan pesan sukses atau error jika ada -->
            @if(session('success') || session('error'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    @if(session('success'))
                        Swal.fire({
                            icon: 'success',
                            title: 'BERHASIL',
                            text: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    @elseif(session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'GAGAL!',
                            text: "{{ session('error') }}",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    @endif
                </script>
            @endif

            <table class="table table-bordered table-striped">
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
                    @forelse ($pendaftars as $pendaftar)
                    <tr>
                        <td>{{ $pendaftar->nama_lengkap }}</td>
                        <td>{{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d M Y') }}</td>
                        <td>{{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $pendaftar->alamat }}</td>
                        <td>{{ $pendaftar->email }}</td>
                        <td>{{ $pendaftar->no_hp }}</td>
                        <td class="text-center">
                            <form action="{{ route('pendaftars.destroy', $pendaftar->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini?');">
                                <a href="{{ route('pendaftars.edit', $pendaftar->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                <a href="{{ route('pendaftars.show', $pendaftar->id) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Data Pendaftar Belum Tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination links -->
            <div class="d-flex justify-content-center">
                {{ $pendaftars->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
