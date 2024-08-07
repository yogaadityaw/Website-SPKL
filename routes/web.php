<?php

use App\Http\Controllers\AdminController\BengkelController;
use App\Http\Controllers\AdminController\ChangeRoleController;
use App\Http\Controllers\AdminController\DashboardAdminController;
use App\Http\Controllers\AdminController\DepartemenController;
use App\Http\Controllers\AdminController\ProyekController;
use App\Http\Controllers\AdminController\PtController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonSpklController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DepartemenController\DashboardDepartemenController;
use App\Http\Controllers\DepartemenController\PengajuanSpklDepartemenController;
use App\Http\Controllers\KabengController\DashboardKabengController;
use App\Http\Controllers\KabengController\ManageSpklController;
use App\Http\Controllers\KabengController\PegawaiBengkelController;
use App\Http\Controllers\KabengController\PengajuanSpklKabengController;
use App\Http\Controllers\KemenproController\DashboardKemenproController;
use App\Http\Controllers\KemenproController\PengajuanSpklKemenproController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PegawaiController\DashboardPegawaiController;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('test-view', function () {
    return view('pages.error-404');
});

Route::get('/', [AuthController::class, 'showLogin'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/print-spkl/{id_spkl}', [DashboardKabengController::class, 'printSpkl'])->name('print-spkl');


Route::prefix('common')->group(function () {
    Route::get('/get-spkl/{id}', [CommonSpklController::class, 'getSpkl'])->name('get-spkl');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard-admin');
    Route::get('/change-role', [ChangeRoleController::class, 'index'])->name('change-role');
    Route::get('/change-role/edit/{id}', [ChangeRoleController::class, 'getUserData']);
    Route::put('/change-role/update', [ChangeRoleController::class, 'updateRole'])->name('users-update');
    Route::delete('/change-role/delete', [ChangeRoleController::class, 'deleteUser'])->name('users-delete');
    Route::get('/proyek-list', [ProyekController::class, 'index'])->name('proyek-list');
    Route::post('/proyek-list/baru', [ProyekController::class, 'TambahProyek'])->name('proyek-baru-post');
    Route::get('/proyek-list/edit/{id_proyek}', [ProyekController::class, 'getProyekData']);
    Route::put('/poyek-list/update', [ProyekController::class, 'updateProyek'])->name('proyek-update');
    Route::delete('/proyek-list/delete', [ProyekController::class, 'deleteProyek'])->name('proyek-delete');
    Route::get('/pt-list', [PtController::class, 'index'])->name('pt-list');
    Route::post('/pt-list/baru', [PtController::class, 'TambahPt'])->name('pt-baru-post');
    Route::get('/pt-list/edit/{id_pt}', [PtController::class, 'getPtData']);
    Route::put('/pt-list/update', [PtController::class, 'updatePt'])->name('pt-update');
    Route::delete('/pt-list/delete', [PtController::class, 'deletePt'])->name('pt-delete');
    Route::get('/bengkel-list', [BengkelController::class, 'index'])->name('bengkel-list');
    Route::post('/bengkel-list/baru', [BengkelController::class, 'TambahBengkel'])->name('bengkel-baru-post');
    Route::get('/bengkel-list/edit/{id_bengkel}', [BengkelController::class, 'getBengkelData']);
    Route::put('/bengkel-list/update', [BengkelController::class, 'updateBengkel'])->name('bengkel-update');
    Route::delete('/bengkel-list/delete', [BengkelController::class, 'deleteBengkel'])->name('bengkel-delete');
    Route::get('/departemen-list', [DepartemenController::class, 'index'])->name('departemen-list');
    Route::post('/departemen-list/baru', [DepartemenController::class, 'TambahDepartemen'])->name('departemen-baru-post');
    Route::get('/departemen-list/edit/{id_departemen}', [DepartemenController::class, 'getDepartemenData']);
    Route::put('/departemen-list/update', [DepartemenController::class, 'updateDepartemen'])->name('departemen-update');
    Route::delete('/departemen-list/delete', [DepartemenController::class, 'deleteDepartemen'])->name('departemen-delete');
    Route::get('/list-spkl-admin', [DashboardAdminController::class, 'listSpklAdmin'])->name('list-spkl-admin');
    Route::get('/view-spkl-admin/{id}', [DashboardAdminController::class, 'viewSpklAdmin'])->name('view-spkl-admin');
    Route::get('/getChart', [DashboardAdminController::class, 'getChart'])->name('get-admin-chart');
    Route::put('/input-jam-realisasi/{id}', [DashboardAdminController::class, 'inputJamRealisasi'])->name('input-jam-realisasi-admin');
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
    Route::put('/input-jam-realisasi/{id}', [PengajuanSpklKabengController::class, 'inputJamRealisasi'])->name('input-jam-realisasi');
    Route::get('/ubah-spkl/{id}', [PengajuanSpklKabengController::class, 'ubahInformasi'])->name('ubah-informasi');
    Route::put('/ubah-spkl/{id}', [PengajuanSpklKabengController::class, 'fungsiUbahInformasi'])->name('fungsi-ubah-informasi');
});

Route::prefix('departemen')->group(function () {
    Route::get('/dashboard', [DashboardDepartemenController::class, 'index'])->name('dashboard-departemen');
    Route::get('/pengajuan-spkl-departemen', [PengajuanSpklDepartemenController::class, 'index'])->name('pengajuan-spkl-departemen');
    Route::get('/detail-spkl-departemen/{id}', [PengajuanSpklDepartemenController::class, 'getDetailSpkl'])->name('detail-spkl-departemen');
    Route::put('/pengajuan-spkl-audit', [PengajuanSpklDepartemenController::class, 'auditSpkl'])->name('audit-spkl-departemen');
    Route::put('/tolak-spkl/{id}', [PengajuanSpklDepartemenController::class, 'tolakSpkl'])->name('tolak-spkl');
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
    Route::post('/surat-pengajuan/checkout', [DashboardPegawaiController::class, 'checkout'])->name('checkout-spkl-pegawai');
    Route::get('/detail-spkl-pegawai/{id}', [DashboardPegawaiController::class, 'getDetailSpkl'])->name('detail-spkl-pegawai');
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
