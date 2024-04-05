<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAdminController\ChangeRoleController;
use App\Http\Controllers\DashboardKabengController\ManageSpklController;
use App\Http\Controllers\DashboardAdminController\DashboardAdminController;
use App\Http\Controllers\DashboardKabengController\DashboardKabengController;
use App\Http\Controllers\DashboardPegawaiController\DashboardPegawaiController;
use App\Http\Controllers\DashboardKemenproController\DashboardKemenproController;
use App\Http\Controllers\DashboardDepartemenController\DashboardDepartemenController;


Route::get('test-view', function () {
    return view('pages.bootstrap-dropdown');
});

Route::get('/', [AuthController::class, 'showLogin'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');;


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard-admin');
    Route::get('/change-role', [ChangeRoleController::class, 'index'])->name('change-role');
    Route::get('/change-role/edit/{id}', [ChangeRoleController::class, 'getUserData']);
    Route::put('/change-role/update', [ChangeRoleController::class, 'updateRole'])->name('users-update');

});

Route::prefix('kabeng')->group(function () {
    Route::get('/dashboard', [DashboardKabengController::class, 'index'])->name('dashboard-kabeng');
    Route::get('/create-spkl', [ManageSpklController::class, 'index'])->name('create-spkl');
});

Route::prefix('departemen')->group(function () {
    Route::get('/dashboard', [DashboardDepartemenController::class, 'index'])->name('dashboard-departemen');
});

Route::prefix('kemenpro')->group(function () {
    Route::get('/dashboard', [DashboardKemenproController::class, 'index'])->name('dashboard-kemenpro');
});

Route::prefix('pegawai')->group(function () {
    Route::get('/dashboard', [DashboardPegawaiController::class, 'index'])->name('dashboard-pegawai');
});

Route::prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard-user');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::get('/unauthorized', function () {
    return view('pages.error-403');
})->name('unauthorized');
