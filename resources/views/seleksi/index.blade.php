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

        <style>
            /* CSS untuk tabel */
            .table th, .table td {
                text-align: center; /* Rata tengah untuk teks */
            }

            /* CSS untuk kolom Email */
            .email-column {
                width: 180px; /* Lebar kolom Email */
                max-width: 180px; /* Maksimal lebar kolom */
                overflow: hidden; /* Sembunyikan konten yang melampaui */
                text-overflow: ellipsis; /* Tampilkan elipsis jika teks terlalu panjang */
                white-space: nowrap; /* Mencegah teks untuk membungkus ke baris baru */
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
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
                                <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>  <!-- Ikon pendaftaran -->
                                Tambah Pendaftaran
                            </a>
                            <a class="nav-link" href="seleksi">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-check"></i></div>  <!-- Ikon seleksi -->
                                Seleksi Siswa/Siswi
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm rounded">
                                    <div class="card-body">
                                        <!-- Tombol Kembali ke Dashboard -->
                                        <a href="{{ route('dashboard') }}" class="btn btn-md btn-secondary mb-3">KEMBALI KE DASHBOARD</a>
                                        <!-- Tabel Data Seleksi -->
                                        <h3 class="mb-4">Hasil Seleksi</h3>
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Lengkap</th>
                                                    <th scope="col">Jenis Kelamin</th>
                                                    <th scope="col">Tanggal Lahir</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col" class="email-column">Email</th>  <!-- Kolom Email dengan kelas email-column -->
                                                    <th scope="col">No HP</th>
                                                    <th scope="col">Foto</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 20%">Aksi</th>
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
                                                        <td class="email-column">{{ $seleksi->pendaftar->email }}</td>  <!-- Kolom Email -->
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
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
