<?php

use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return redirect('/login'); });

Route::middleware(['guest'])->group(function () {
    // ROUTE LOGIN
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/auth', [LoginController::class, 'auth'])->name('auth');

    // ROUTE REGISTRASI
    Route::get('/registrasi', [LoginController::class, 'registrasi'])->name('registrasi');
    Route::post('/store-registrasi', [LoginController::class, 'store'])->name('store-registrasi');
});

// ROUTE LOGOUT
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // ROUTE DAHSBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ROUTE DATA BUKU
    Route::get('data-buku', [DataBukuController::class, 'index'])->name('data-buku');
    Route::get('create-buku', [DataBukuController::class, 'create'])->name('create-buku');
    Route::post('store-buku', [DataBukuController::class, 'store'])->name('store-buku');
    Route::get('edit-buku/{id}', [DataBukuController::class, 'edit'])->name('edit-buku');
    Route::put('update-buku/{id}', [DataBukuController::class, 'update'])->name('update-buku');
    Route::get('delete-buku/{id}', [DataBukuController::class, 'destroy'])->name('delete-buku');
    Route::get('export-pdf-buku', [DataBukuController::class, 'export_pdf_buku'])->name('export-pdf-buku');
    Route::get('export-excel-buku', [DataBukuController::class, 'export_excel_buku'])->name('export-excel-buku');
    Route::post('import-excel-buku', [DataBukuController::class, 'import_excel_buku'])->name('import-excel-buku');

    // ROUTE PEMINJAMAN
    Route::get('data-peminjaman', [PeminjamanController::class, 'index'])->name('data-peminjaman');
    Route::get('create-peminjaman', [PeminjamanController::class, 'create'])->name('create-peminjaman');
    Route::post('store-peminjaman', [PeminjamanController::class, 'store'])->name('store-peminjaman');

});
