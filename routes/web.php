<?php

use App\Helper\GenerateRandomSpklNumber;
use App\Http\Controllers\AdminController\ProyekController;
use App\Http\Controllers\DepartemenController\PengajuanSpklDepartemenController;
use App\Http\Controllers\KabengController\PegawaiBengkelController;
use App\Http\Controllers\KemenproController\PengajuanSpklKemenproController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\AdminController\ChangeRoleController;
use App\Http\Controllers\KabengController\ManageSpklController;
use App\Http\Controllers\KabengController\PengajuanSpklKabengController;
use App\Http\Controllers\AdminController\DashboardAdminController;
use App\Http\Controllers\KabengController\DashboardKabengController;
use App\Http\Controllers\PegawaiController\DashboardPegawaiController;
use App\Http\Controllers\KemenproController\DashboardKemenproController;
use App\Http\Controllers\DepartemenController\DashboardDepartemenController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('test-view', function () {
    return view('pages.forms-advanced-form');
});

Route::get('/', [AuthController::class, 'showLogin'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard-admin');
    Route::get('/change-role', [ChangeRoleController::class, 'index'])->name('change-role');
    Route::get('/change-role/edit/{id}', [ChangeRoleController::class, 'getUserData']);
    Route::put('/change-role/update', [ChangeRoleController::class, 'updateRole'])->name('users-update');
    Route::delete('/change-role/delete', [ChangeRoleController::class, 'deleteUser'])->name('users-delete');
    Route::get('/proyek-list',[ProyekController::class, 'index'])->name('proyek-list');
    Route::post('/proyek-list/baru',[ProyekController::class, 'TambahProyek'])->name('proyek-baru-post');
    Route::get('/proyek-list/edit/{id_proyek}',[ProyekController::class, 'getProyekData']);
    Route::put('/poyek-list/update',[ProyekController::class, 'updateProyek'])->name('proyek-update'); // Menambahkan route untuk update proyek
    Route::delete('/proyek-list/delete',[ProyekController::class, 'deleteProyek'])->name('proyek-delete');
});

Route::prefix('kabeng')->group(function () {
    Route::get('/dashboard', [DashboardKabengController::class, 'index'])->name('dashboard-kabeng');
    Route::get('/pegawai-bengkel/', [PegawaiBengkelController::class, 'index'])->name('pegawai-bengkel');
    Route::get('/create-spkl', [ManageSpklController::class, 'index'])->name('create-spkl');
    Route::get('/pengajuan-spkl', [PengajuanSpklKabengController::class, 'index'])->name('pengajuan-spkl');
    Route::post('/pengajuan-spkl-post', [PengajuanSpklKabengController::class, 'post'])->name('pengajuan-spkl-post');
    Route::get('/detail-spkl/{id}', [PengajuanSpklKabengController::class, 'getDetailSpkl'])->name('detail-spkl');
    Route::get('/deletespkl/{id}', [PengajuanSpklKabengController::class, 'getspklDelete'])->name('getidspkl');
    Route::delete('/pengajuan-spkl-delete', [PengajuanSpklKabengController::class, 'deleteSpkl'])->name('delete-spkl');
    Route::put('/pengajuan-spkl-audit', [PengajuanSpklKabengController::class, 'auditSpkl'])->name('audit-spkl-kabeng');
});

Route::prefix('departemen')->group(function () {
    Route::get('/dashboard', [DashboardDepartemenController::class, 'index'])->name('dashboard-departemen');
    Route::get('/pengajuan-spkl-departemen', [PengajuanSpklDepartemenController::class, 'index'])->name('pengajuan-spkl-departemen');
    Route::get('/detail-spkl-departemen/{id}', [PengajuanSpklDepartemenController::class, 'getDetailSpkl'])->name('detail-spkl-departemen');
    Route::put('/pengajuan-spkl-audit', [PengajuanSpklDepartemenController::class, 'auditSpkl'])->name('audit-spkl-departemen');
});

Route::prefix('kemenpro')->group(function () {
    Route::get('/dashboard', [DashboardKemenproController::class, 'index'])->name('dashboard-kemenpro');
    Route::get('/pengajuan-spkl-kemenpro', [PengajuanSpklKemenproController::class, 'index'])->name('pengajuan-spkl-kemenpro');
    Route::get('/detail-spkl-kemenpro/{id}', [PengajuanSpklKemenproController::class, 'getDetailSpkl'])->name('detail-spkl-kemenpro');
    Route::put('/pengajuan-spkl-audit', [PengajuanSpklKemenproController::class, 'auditSpkl'])->name('audit-spkl-kemenpro');
});

Route::prefix('pegawai')->group(function () {
    Route::get('/dashboard', [DashboardPegawaiController::class, 'index'])->name('dashboard-pegawai');
    Route::get('/surat-pengajuan', [DashboardPegawaiController::class, 'listSpklPegawai'])->name('list-spkl-pegawai');
    Route::post('/surat-pengajuan/absen', [DashboardPegawaiController::class, 'absen'])->name('absen-spkl-pegawai');
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


Route::get('/qr-code', function () {
    return QrCode::generate(asset(''));
});

Route::get('test-document', function () {
    return view('test-document');
});
