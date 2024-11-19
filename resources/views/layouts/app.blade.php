<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - SLBN 1 PELAIHARI')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet">
</head>
<body class="sb-nav-fixed">
    <!-- Navbar & Sidebar -->
    @include('partials.navbar') <!-- Navbar dan Sidebar disertakan di sini -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- Sidebar Menu -->
            @include('partials.sidebar') <!-- Menggunakan partials untuk sidebar -->
        </div>
        <div id="layoutSidenav_content">
            <main>
                <!-- Konten halaman yang berubah -->
                <div class="container-fluid mt-4">
                    @yield('content') <!-- Konten dinamis halaman -->
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
