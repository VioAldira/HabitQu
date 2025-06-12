<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - TaskMate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 900px;
            margin: auto;
            margin-top: 50px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .form-check-label a {
            color: red;
            text-decoration: none;
        }
        .btn-primary {
            background-color: #4d62f0;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3c4fd4;
        }
    </style>
</head>
<body>

<div class="container form-container row">
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img src="{{ asset('images/Sign up.png') }}" alt="Register Image" class="img-fluid">
    </div>
    <div class="col-md-6">
        <h3 class="fw-bold">Daftar Akun</h3>
        <p class="text-muted">Mari kita persiapkan semuanya agar Anda dapat mengakses akun pribadi Anda.</p>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Username" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label" for="terms">
                    Saya setuju dengan semua <a href="#">Persyaratan</a> dan <a href="#">Kebijakan Privasi</a>
                </label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Buat akun</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
