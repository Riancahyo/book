<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;

// Halaman Welcome (bisa diakses tanpa login)
Route::view('/', 'welcome')->name('welcome');

// Halaman kategori untuk user
Route::get('/user/categories', [CategoryController::class, 'userCategories'])->name('user.categories');
    // ->middleware('auth');
Route::get('/user/loans', [LoanController::class, 'userLoans'])->name('user.loans')
->middleware('auth');

// Halaman buku untuk user
Route::get('/user/books', [BookController::class, 'userBooks'])->name('user.books');
    // ->middleware('auth');

// Rute untuk halaman login dan register, mengarah ke halaman login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Halaman dashboard hanya untuk admin setelah login
Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Profile hanya bisa diakses oleh user yang sudah login
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Logout route
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk admin, hanya admin yang bisa mengakses
Route::group(['middleware' => ['auth']], function () {
    Route::resource('books', BookController::class);  // Rute untuk mengelola buku
    Route::resource('loans', LoanController::class);  // Rute untuk mengelola pinjaman
    Route::resource('categories', CategoryController::class);  // Rute untuk mengelola kategori
});

// Rute yang hanya dapat diakses oleh user yang terautentikasi
Route::group(['middleware' => ['auth']], function () {
    // Anda bisa menambahkan rute-rute user yang hanya bisa diakses jika sudah login di sini
    // Misalnya:
    // Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

require __DIR__.'/auth.php';
