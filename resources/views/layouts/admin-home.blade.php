<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-light p-3 sticky-top" style="width: 250px; height: 100vh;">
            <h4 class="mb-4">TApp</h4>
            <ul class="nav flex-column">
                <li class="nav-item dropdown mb-3">
                    <a class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown" href="#" role="button">Input Data Baru</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="mahasiswa.create">Mahasiswa</a></li>
                        <li><a class="dropdown-item" href="dosen.create">Dosen</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-3">
                    <a href="jadwal-create" class="nav-link text-light">Buat Jadwal Sidang Baru</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="{{ route('admin.jadwal.list') }}" class="nav-link text-light">Jadwal Sidang Mahasiswa</a>
                </li>
                <li class="nav-item dropdown mb-3">
                    <a class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown" href="#" role="button">Lihat Data</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="daftar-mahasiswa">Mahasiswa</a></li>
                        <li><a class="dropdown-item" href="daftar-dosen">Dosen</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-3">
                    <a href="#" class="nav-link text-light">Daftar Nilai Mahasiswa</a>
                </li>
            </ul>
        </nav>

        <!-- Content -->
        <div style="flex: 1;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-dark text-light sticky-top">
                <div class="container-fluid">
                    <form action="{{ route('logout') }}" method="POST" class="d-flex ms-auto">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>