<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>TApp</title>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-light p-3" style="width: 250px; height: 100vh;">
            <h4 class="mb-4">TApp</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a href="jadwal-sidang" class="nav-link text-light">Cek Jadwal Sidang</a>
                </li>
            </ul>
        </nav>

        <!-- Content -->
        <div style="flex: 1;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-dark text-light">
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