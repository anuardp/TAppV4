<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-light background" style="background-image: url('images/Widyatama.jpg'); background-size: 100%;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 400px;">
            <h3 class="text-center">Login</h3>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" id="loginButton" disabled>Login</button>
            </form>
        </div>
    </div>
    <script>
        const loginButton = document.getElementById('loginButton');
        const username = document.getElementById('username');
        const password = document.getElementById('password');

        function validateForm() {
            loginButton.disabled = !username.value || !password.value;
        }

        username.addEventListener('input', validateForm);
        password.addEventListener('input', validateForm);
    </script>
</body>
</html>
