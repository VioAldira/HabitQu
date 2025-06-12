{{-- File: resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Bagian Header Profil --}}
    <div class="card card-custom mb-5" style="background-color: #f0f2f5;">
        <div class="card-body p-4 d-flex align-items-center">
            <img src="{{ asset('images/akun.png') }}" alt="Ikon Akun" class="me-4" style="width: 80px; height: 80px;">

            <div>
                <h2 class="mb-0">{{ $user->name }}</h2>
                <p class="text-muted mb-0">{{ $user->email }}</p>
            </div>
        </div>
    </div>

    {{-- Pengaturan Akun (Update Profil) --}}
    <div class="card card-custom mb-5">
        <div class="card-header card-header-custom">
            <h4 class="mb-0">Pengaturan Akun</h4>
        </div>
        <div class="card-body p-4">
             @if (session('status') === 'profile-updated')
                <div class="alert alert-success" role="alert">
                    Profil berhasil diperbarui.
                </div>
            @endif
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                     @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    {{-- Ganti Kata Sandi --}}
    <div class="card card-custom mb-5">
        <div class="card-header card-header-custom">
             <h4 class="mb-0">Ganti Kata Sandi</h4>
        </div>
        <div class="card-body p-4">
            @if (session('status') === 'password-updated')
                <div class="alert alert-success" role="alert">
                    Kata sandi berhasil diperbarui.
                </div>
            @endif
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Kata Sandi Lama</label>
                    <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" required>
                     @error('current_password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                 <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi Baru</label>
                    <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" required>
                     @error('password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                 <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
            </form>
        </div>
    </div>

    {{-- Tombol Aksi di Bawah --}}
    <<div class="d-flex justify-content-end align-items-center mb-5">
         <a href="{{ route('tasks.index') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Homepage
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>
@endsection