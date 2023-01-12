<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GasController;
use App\Http\Controllers\GalonController;
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
Route::resource('user', UserController::class)->middleware('userLoginStatus');

# Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('userLoginStatus');

# Penjualan
Route::resource('dashboard/penjualan_gas', GasController::class)->middleware('userLoginStatus');
Route::resource('dashboard/penjualan_galon', GalonController::class)->middleware('userLoginStatus');

# Login, Logout, Register, Change Password
Route::get('login', [SessionController::class, 'index'])->middleware('userGuestStatus');

# 1. Login
Route::post('session/login', [SessionController::class, 'login'])->middleware('userGuestStatus');
Route::get('session/logout', [SessionController::class, 'logout']);

# 2. Register
Route::get('register', [SessionController::class, 'register'])->middleware('userGuestStatus');
Route::post('session/create', [SessionController::class, 'create'])->middleware('userGuestStatus');

# 3. Change Password
Route::get('change-password', [UserController::class, 'changePassword'])->middleware('userLoginStatus');
Route::post('change-password', [UserController::class, 'updatePassword'])->middleware('userLoginStatus');

