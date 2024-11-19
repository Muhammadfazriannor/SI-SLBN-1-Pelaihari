<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Detail Pendaftar</title>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <!-- Foto Pendaftar -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body text-center">
                        @if($pendaftar->foto)
                            <img src="{{ Storage::url($pendaftar->foto) }}" alt="Foto Pendaftar" class="img-fluid rounded" style="max-width: 100%;">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Foto Tidak Tersedia" class="img-fluid rounded">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informasi Pendaftar -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Detail Pendaftar</h3>
                        <p><strong>Nama Lengkap:</strong> {{ $pendaftar->nama_lengkap }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ date('d-m-Y', strtotime($pendaftar->tanggal_lahir)) }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        <p><strong>Alamat:</strong> {{ $pendaftar->alamat }}</p>
                        <p><strong>Email:</strong> {{ $pendaftar->email }}</p>
                        <p><strong>No HP:</strong> {{ $pendaftar->no_hp }}</p>

                        <!-- Tombol Kembali -->
                        <div class="text-center mt-4">
                            <a href="{{ route('pendaftars.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
