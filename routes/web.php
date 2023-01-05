<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GasController;
use App\Http\Controllers\GalonController;
use App\Http\Controllers\SessionController;

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


Route::resource('penjualan_gas', GasController::class)->middleware('userLoginStatus');
Route::resource('penjualan_galon', GalonController::class);

# Login, Logout, Register
Route::get('/login', [SessionController::class, 'index'])->middleware('userGuestStatus');

Route::post('session/login', [SessionController::class, 'login'])->middleware('userGuestStatus');
Route::get('session/logout', [SessionController::class, 'logout']);

Route::get('/register', [SessionController::class, 'register'])->middleware('userGuestStatus');
Route::post('session/create', [SessionController::class, 'create'])->middleware('userGuestStatus');