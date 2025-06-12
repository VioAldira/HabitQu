<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-config_initial_auth_token8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskMate') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    
    {{-- Atau jika menggunakan Bootstrap CDN secara manual: --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa; /* Warna latar belakang netral */
        }
        .navbar {
            margin-bottom: 20px;
            background-color: #ffffff; /* Navbar putih */
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card-custom {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.1);
            margin-bottom: 1.5rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-primary {
            background-color: #0d6efd; /* Biru Bootstrap standar */
            border-color: #0d6efd;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        .btn-danger {
            background-color: #dc3545; /* Merah Bootstrap standar */
            border-color: #dc3545;
        }
        .btn-warning {
            color: #000; /* Teks hitam agar kontras dengan kuning */
        }
        .footer {
            padding: 20px 0;
            text-align: center;
            background-color: #343a40; /* Footer gelap */
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 0.9em;
        }
        .content-wrap {
            padding-bottom: 80px; /* Tinggi footer + sedikit margin */
        }
        .form-label {
            font-weight: 500;
        }
        .task-title-link {
            color: inherit;
            text-decoration: none;
        }
        .task-title-link:hover {
            color: #0d6efd;
        }
        .status-badge {
            font-size: 0.9em;
        }
        .action-buttons .btn {
            margin-right: 5px;
        }
         .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .card-header-custom {
            background-color: #f0f2f5;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo TaskMate dari folder public/images -->
        <a class="navbar-brand d-flex align-items-center mb-0 h1" href="{{ url('/') }}">
            <img src="{{ asset('images/habitqu-logo.png') }}" alt="TaskMate Logo" style="height: 30px; margin-right: 8px;">
            <span class="fw-bold text-dark">HabitQu</span>
        </a>

        <!-- Tautan kanan tetap sama -->
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-none d-md-flex" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="bi bi-person-fill me-2"></i>Akun Saya
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>



        <main class="py-4 content-wrap">
            <div class="container">
                 @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                 @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>

        <footer class="footer mt-auto py-3 bg-dark">
            <div class="container text-center">
                <span class="text-light">© {{ date('Y') }} - To Do List. Designed by HabitQu Designer. All rights reserved.</span>
            </div>
        </footer>
    </div>
    {{-- Script Bootstrap jika menggunakan CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>