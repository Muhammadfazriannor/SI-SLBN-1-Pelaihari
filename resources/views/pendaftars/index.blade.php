<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Mengatur tombol aksi untuk tampil secara vertikal */
        .btn-group-vertical .btn {
            width: 100%;
            margin-bottom: 5px; /* Jarak antar tombol */
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="pengumumen">
                            <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                            Tambah Pengumuman
                        </a>
                        <a class="nav-link" href="pendaftars">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>  
                            Tambah Pendaftaran
                        </a>
                        <a class="nav-link" href="seleksi">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-check"></i></div>  
                            Seleksi Siswa/Siswi
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div style="background: #f5f5f5;">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm rounded">
                                    <div class="card-body">
                                        <!-- Judul Halaman -->
                                        <h2 class="mb-4">Tambah Pendaftaran</h2>

                                        <!-- Tombol kembali ke dashboard -->
                                        <a href="{{ route('dashboard') }}" class="btn btn-md btn-secondary mb-3">KEMBALI KE DASHBOARD</a>
                                        <!-- Tombol untuk menambah pendaftar -->
                                        <a href="{{ route('pendaftars.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PENDAFTAR</a>

                                        <!-- Menampilkan pesan sukses atau error -->
                                        @if(session('success') || session('error'))
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

                                        <!-- Tabel Data Pendaftar -->
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
                                                            <div class="btn-group-vertical" role="group">
                                                                <!-- Tombol Edit -->
                                                                <a href="{{ route('pendaftars.edit', $pendaftar) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Pendaftar">EDIT</a>
                                                                <!-- Tombol Hapus -->
                                                                <form action="{{ route('pendaftars.destroy', $pendaftar) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Pendaftar">HAPUS</button>
                                                                </form>
                                                                <!-- Tombol Lihat -->
                                                                <a href="{{ route('pendaftars.show', $pendaftar) }}" class="btn btn-sm btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail">LIHAT</a>
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
                </div>

                <!-- Bootstrap JS Bundle -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                <script>
                    // Inisialisasi tooltip Bootstrap
                    var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                    var tooltipList = [...tooltipTriggerList].map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                </script>

            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
