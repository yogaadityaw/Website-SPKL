<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController\DashboardAdminController;
use App\Http\Controllers\DashboardController\DashboardDepartemenController;
use App\Http\Controllers\DashboardController\DashboardKabengController;
use App\Http\Controllers\DashboardController\DashboardKemenproController;
use App\Http\Controllers\DashboardController\DashboardPegawaiController;
use App\Http\Controllers\DashboardController\DashboardUserController;
use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('test-view', function () {
    return view('pages.auth-login2');
});

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');;

Route::get('/dashboard-admin', [DashboardAdminController::class, 'index']);
Route::get('/dashboard-kabeng', [DashboardKabengController::class, 'index']);
Route::get('/dashboard-departemen', [DashboardDepartemenController::class, 'index']);
Route::get('/dashboard-kemenpro', [DashboardKemenproController::class, 'index']);
Route::get('/dashboard-pegawai', [DashboardPegawaiController::class, 'index']);
Route::get('/dashboard-user', [DashboardUserController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::get('/unauthorized', function () {
    return view('pages.error-403');
})->name('unauthorized');
