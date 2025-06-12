<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | HabitQu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }
        .login-section {
            min-height: 100vh;
        }
        .login-box {
            max-width: 400px;
            margin: auto;
        }
        .btn-primary {
            background-color: #4f5eff;
            border-color: #4f5eff;
        }
        .btn-primary:hover {
            background-color: #3d49cc;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #4f5eff;
        }
    </style>
</head>
<body>
    <div class="container-fluid login-section d-flex align-items-center justify-content-center">
        <div class="row w-100">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center">
                <img src="{{ asset('images/habitqu-logo.png') }}" alt="TaskMate" class="mb-4" style="height: 50px;">
                <h2 class="fw-bold">Login</h2>
                <p class="mb-4">Masuk untuk mengakses akun HabitQu Anda</p>

                <form action="{{ route('login') }}" method="POST" class="login-box w-100">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;">
                            👁️ <!-- ganti dengan icon jika pakai feather/fontawesome -->
                        </span>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p> Tidak Punya Akun HabitQu? <a href="{{ route('register') }}" class="text-danger">Daftar</a>

            </div>

            <div class="col-md-6 d-none d-md-block text-center">
                <img src="{{ asset('images/login-illustration.png') }}" alt="Login Illustration" class="img-fluid" style="max-height: 500px;">
            </div>
        </div>
    </div>
</body>
</html>
