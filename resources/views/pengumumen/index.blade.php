@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Tombol Kembali ke Dashboard -->
                        <a href="{{ route('dashboard') }}" class="btn btn-md btn-secondary mb-3">KEMBALI KE DASHBOARD</a>
                        <a href="{{ route('pengumumen.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PENGUMUMAN</a>
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">FOTO</th>
                                    <th scope="col">JUDUL</th>
                                    <th scope="col">ISI KONTEN</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengumuman as $item)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/pengumumen/'.$item->foto) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ Str::limit($item->isi, 50) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pengumumen.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('pengumumen.show', $item->id) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                                <a href="{{ route('pengumumen.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="alert alert-danger">
                                                Data Pengumuman belum Tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $pengumuman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
@endsection
