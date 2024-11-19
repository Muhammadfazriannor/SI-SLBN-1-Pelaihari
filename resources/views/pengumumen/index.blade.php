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
                                        <!-- Judul Halaman Tambah Pengumuman -->
                                        <h3 class="mb-4">Tambah Pengumuman</h3> <!-- Judul Halaman -->

                                        <!-- Tombol Kembali ke Dashboard dan Tambah Pengumuman (placed below the heading) -->
                                        <div class="d-flex justify-content-start mb-3">
                                            <!-- Tombol Kembali ke Dashboard -->
                                            <a href="{{ route('dashboard') }}" class="btn btn-md btn-secondary me-3">KEMBALI KE DASHBOARD</a>

                                            <!-- Tombol untuk menambah pengumuman -->
                                            <a href="{{ route('pengumumen.create') }}" class="btn btn-md btn-success">TAMBAH PENGUMUMAN</a>
                                        </div>

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
                                                    <div class="alert alert-danger">
                                                        Data Pengumuman belum Tersedia.
                                                    </div>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{ $pengumuman->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
