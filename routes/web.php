<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

# Profile User
Route::resource('user', UserController::class)->middleware('userLoginStatus'); # menampilkan halaman profil user

# Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('userLoginStatus'); # menampilkan halaman dashboard




/*
|--------------------------------------------------------------------------------
| Route penjualan
|--------------------------------------------------------------------------------
|
| Route untuk penjualan mulai dari menampilkan halaman index, create, dan edit
| serta method untuk menyimpan, edit, dan menghapus penjualan berdasarkan id
|
*/

# 1. menampilkan halaman index
Route::get('penjualan', [PenjualanController::class, 'index'])->middleware('userLoginStatus');

# 2. edit barang
Route::get('penjualan/{id}/edit', [PenjualanController::class, 'edit'])->middleware('IsAdminStatus'); # menampilkan halaman edit
Route::put('penjualan/{id}', [PenjualanController::class, 'update'])->middleware('IsAdminStatus'); # method untuk menyimpan hasil update/edit

# 3. create barang
Route::get('penjualan/create', [PenjualanController::class, 'create'])->middleware('userLoginStatus'); # menampilkan halaman create
Route::post('penjualan', [PenjualanController::class, 'store'])->middleware('userLoginStatus'); # method untuk menyimpan data penjualan baru

# 4. menghapus barang
Route::delete('penjualan/{id}', [PenjualanController::class, 'destroy'])->middleware('IsAdminStatus'); # method menghapus data penjualan

# jika ingin membuat route otomatis pakai kode di bawah ini 
// Route::resource('penjualan', PenjualanController::class)->middleware('userLoginStatus');




/*
|--------------------------------------------------------------------------------
| Route Barang
|--------------------------------------------------------------------------------
|
| Route untuk barang mulai dari menampilkan halaman index, create, dan edit
| serta method untuk menyimpan, edit, dan menghapus barang berdasarkan id
|
*/

# 1. menampilkan halaman index
Route::get('barang', [BarangController::class, 'index'])->middleware('userLoginStatus');

# 2. edit barang
Route::get('barang/{id}/edit', [BarangController::class, 'edit'])->middleware('IsAdminStatus'); # menampilkan halaman edit
Route::put('barang/{id}', [BarangController::class, 'update'])->middleware('IsAdminStatus'); # method untuk menyimpan hasil update/edit

# 3. create barang
Route::get('barang/create', [BarangController::class, 'create'])->middleware('IsAdminStatus'); # menampilkan halaman create
Route::post('barang', [BarangController::class, 'store'])->middleware('IsAdminStatus'); # method untuk menyimpan barang baru

# 4. menghapus barang
Route::delete('barang/{id}', [BarangController::class, 'destroy'])->middleware('IsAdminStatus'); # method menghapus barang

# jika ingin membuat route otomatis pakai kode di bawah ini 
// Route::resource('barang', BarangController::class)->middleware('userLoginStatus');




/*
|--------------------------------------------------------------------------------
| Route Login dan pembuatan akun
|--------------------------------------------------------------------------------
|
| 
| 
|
*/

# menampilkan halaman login
Route::get('login', [SessionController::class, 'index'])->middleware('userGuestStatus');

# 1. Login dan logout
Route::post('session/login', [SessionController::class, 'login'])->middleware('userGuestStatus');
Route::get('session/logout', [SessionController::class, 'logout']);

# 2. Register
Route::get('register', [SessionController::class, 'register'])->middleware('userGuestStatus');
Route::post('session/create', [SessionController::class, 'create'])->middleware('userGuestStatus');

# 3. Change Password
Route::get('change-password', [UserController::class, 'changePassword'])->middleware('userLoginStatus');
Route::post('change-password', [UserController::class, 'updatePassword'])->middleware('userLoginStatus');

