<?php

namespace App\Http\Controllers; // Namespace ini biasanya tidak diperlukan di web.php jika class di-import dengan benar

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\TodoController; // Komentari jika tidak digunakan
// use App\Http\Controllers\TaskController; // Sudah di-import di atas
// use App\Http\Controllers\AuthController; // Sudah di-import di atas

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ini adalah definisi semua route untuk aplikasi.
|
*/

// Route root: arahkan ke welcome jika belum login, atau ke daftar tugas jika sudah login
Route::get('/', function () {
    return view('welcome');
});

// Route auth manual (jika tidak pakai Auth::routes())
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store'); // Seharusnya POST untuk menyimpan registrasi

// Jika pakai Laravel Breeze/Fortify atau UI
//Auth::routes(); // Nonaktifkan ini jika sudah pakai AuthController manual di atas

// Route dashboard (opsional jika masih dipakai view statis)
// Route::get('/dashboard', function () { // BARIS INI DIHAPUS/DIKOMENTARI SESUAI PERMINTAAN
//     return view('todo.homepage');
// });

// Route statis untuk create (jika masih dipakai)
Route::get('/create', function () {
    return view('todo.create');
});

// Route TodoController dan TaskController dengan middleware `auth`
Route::middleware(['auth'])->group(function () {
    // Pastikan method 'home' ada di TodoController jika route ini aktif
    // Jika /home seharusnya menampilkan daftar tugas, arahkan ke TaskController@index
    Route::get('/home', [TaskController::class, 'index'])->name('home'); // Diarahkan ke TaskController untuk konsistensi

    // Pastikan method 'create' ada di TodoController jika route ini aktif
    // Jika ini untuk membuat task, sebaiknya gunakan tasks.create dari resource
    // Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create'); // Hindari bentrok dengan /tasks/create

    // CRUD untuk task
    Route::resource('tasks', TaskController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // ... (route logout Anda) ...
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Tambahkan route logout jika menggunakan AuthController manual
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
