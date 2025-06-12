<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskMate - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            padding-top: 80px;
            position: relative;
            overflow-x: hidden;
        }

        .logo-background {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 80%;
            max-width: 600px;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            z-index: 0;
            pointer-events: none;
        }

        .main-content {
            position: relative;
            z-index: 10;
        }

        .logo-center {
            width: 100px;
            height: auto;
            margin: 20px auto;
        }

        .btn-login {
            background-color: #4f55e1;
            color: white;
        }

        .btn-register {
            border: 1px solid #4f55e1;
            color: #4f55e1;
        }

        @media (max-width: 576px) {
            .btn-container .col {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Logo latar belakang -->
    <img src="{{ asset('images/habitqu-logo.png') }}" alt="TaskMate Background" class="logo-background">

    <div class="container main-content">
        <h1 class="fw-bold">Selamat Datang<br>Di<br>HabitQu</h1>

        <!-- Logo tengah -->
        <img src="{{ asset('images/habitqu-logo.png') }}" alt="TaskMate Logo" class="logo-center">

        <p class="fw-semibold mt-2">Teman Setia Biar Tugas Nggak Lupa.</p>

        <div class="mt-5">
            <div class="row justify-content-center btn-container">
                <div class="col-md-4 text-center">
                    <p class="fw-bold">Sudah Punya Akun HabitQu? Silakan Login!</p>
                    <a href="{{ route('login') }}" class="btn btn-login w-100">Login</a>
                </div>
                <div class="col-md-4 text-center">
                    <p class="fw-bold">Belum Punya Akun HabitQu? Register Sekarang!</p>
                    <a href="{{ route('register') }}" class="btn btn-register w-100">Register</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
