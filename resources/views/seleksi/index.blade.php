<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Pendaftaran PPDB</title>
</head>
<body>
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
                        <td>{{ $seleksi->pendaftar->nama_lengkap }}</td>
                        <td>{{ $seleksi->pendaftar->jenis_kelamin }}</td>
                        <td>{{ $seleksi->pendaftar->tanggal_lahir }}</td>
                        <td>{{ $seleksi->pendaftar->alamat }}</td>
                        <td>{{ $seleksi->pendaftar->email }}</td>
                        <td>{{ $seleksi->pendaftar->no_hp }}</td>
                        <td>
                            @if ($seleksi->pendaftar->foto)
                                <img src="{{ asset('storage/' . $seleksi->pendaftar->foto) }}" alt="Foto" width="100">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
