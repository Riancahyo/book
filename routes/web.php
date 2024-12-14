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
Route::get('/user/loans', [LoanController::class, 'userLoans'])->name('user.loans')
    ->middleware('auth');

// Halaman buku untuk user
Route::get('/user/books', [BookController::class, 'userBooks'])->name('user.books');

// Rute untuk halaman login dan register
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

    // Rute tambahan untuk Soft Delete dan Arsip
    Route::get('books/trashed', [BookController::class, 'trashed'])->name('books.trashed');
    Route::post('books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
    Route::delete('books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.force-delete');
    Route::post('books/{id}/archive', [BookController::class, 'archive'])->name('books.archive');
    Route::post('books/{id}/unarchive', [BookController::class, 'unarchive'])->name('books.unarchive');

    Route::get('categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    Route::get('loans/trashed', [LoanController::class, 'trashed'])->name('loans.trashed');
    Route::post('loans/{id}/restore', [LoanController::class, 'restore'])->name('loans.restore');
    Route::delete('loans/{id}/force-delete', [LoanController::class, 'forceDelete'])->name('loans.force-delete');
});

// Rute untuk user terautentikasi (opsional, sesuai kebutuhan proyek)
Route::group(['middleware' => ['auth']], function () {
    // Tambahkan rute khusus user terautentikasi di sini
});

require __DIR__.'/auth.php';
