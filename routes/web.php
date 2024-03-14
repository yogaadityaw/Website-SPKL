<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
});

Route::get('test-view', function () {
    return view('pages.auth-login2');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');;

Route::get('/dashboard-bengkel', [DashboardController::class, 'dashboardKabeng']);
Route::get('/dashboard-departemen', [DashboardController::class, 'dashboardDepartemen']);
Route::get('/dashboard-kemenpro', [DashboardController::class, 'dashboardKemenpro']);
Route::get('/dashboard-admin', [DashboardController::class, 'dashboardAdmin']);
Route::get('/dashboard-pegawai', [DashboardController::class, 'dashboardPegawai']);
Route::get('/dashboard-user', [DashboardController::class, 'dashboardUser']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::get('/unauthorized', function () {
    return view('pages.error-403');
})->name('unauthorized');
