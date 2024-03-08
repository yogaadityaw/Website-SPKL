<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');;

// Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/dashboard_user', [AuthController::class, 'login']);
Route::get('/dashboard_bengkel', [DashboardController::class ,'kabeng']);
Route::get('/dashboard_departemen', [DashboardController::class ,'departemen']);
Route::get('/dashboard_kemenpro', [DashboardController::class ,'kemenpro']);
Route::get('/dashboard_admin', [DashboardController::class ,'admin']);
Route::get('/dashboard_pegawai', [DashboardController::class ,'pegawai']);
Route::get('/dashboard_user', [DashboardController::class, 'user']);


// Route::get('/dashboard_user', [])
// Route::view('/dashboard_user', 'dashboard_user');