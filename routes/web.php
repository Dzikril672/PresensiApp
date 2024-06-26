<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use App\Models\Karyawan;
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

//Session untuk login karyawan
Route::middleware(['guest:karyawan']) -> group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/loginrequest', [AuthController::class, 'loginrequest']);
});

//Session untuk login admin
Route::middleware(['guest:user']) -> group(function () {
    Route::get('/admin', function () {
        return view('auth.loginAdmin');
    })->name('loginAdmin');
    Route::post('/loginAdminRequest', [AuthController::class, 'loginAdminRequest']);
});

//session agar admin tetap login
Route::middleware(['auth:user'])-> group(function () {
    Route::get('/admin/dashboardAdmin', [DashboardController::class,'dashboardAdmin']);
    Route::get('/logoutrequestAdmin', [AuthController::class,'logoutrequestAdmin']);

    //karyawan
    Route::get('/karyawan', [KaryawanController::class,'index']);
    Route::post('/karyawan/store', [KaryawanController::class,'store']);
    Route::post('/karyawan/editForm', [KaryawanController::class,'editForm']);
    Route::post('/karyawan/{nik}/updateProses', [KaryawanController::class,'updateProses']);
    Route::post('/karyawan/{nik}/deleteProses', [KaryawanController::class,'deleteProses']);

    // //departemen
    Route::get('/departemen', [DepartemenController::class,'index']);
    Route::post('/departemen/store', [DepartemenController::class,'store']);
    Route::post('/departemen/editForm', [DepartemenController::class,'editForm']);
    Route::post('/departemen/{kode_departemen}/updateProses', [DepartemenController::class,'updateProses']);
    Route::post('/departemen/{kode_departemen}/deleteProses', [DepartemenController::class,'deleteProses']);

    //presensi
    Route::get('/presensi/monitoring',[PresensiController::class,'monitoring']);
    Route::post('/getPresensi',[PresensiController::class,'getPresensi']);
    Route::post('/tampilPeta',[PresensiController::class,'tampilPeta']);
    Route::get('/presensi/laporanPresensi',[PresensiController::class,'laporanPresensi']);
    Route::post('/presensi/cetakLaporan',[PresensiController::class,'cetakLaporan']);
    Route::get('/presensi/rekapPresensi',[PresensiController::class,'rekapPresensi']);
    Route::post('/presensi/cetakRekap',[PresensiController::class,'cetakRekap']);
    Route::get('/presensi/kelolaPengajuanIzin',[PresensiController::class,'kelolaPengajuanIzin']);
    Route::post('/presensi/approveIzin',[PresensiController::class,'approveIzin']);
    Route::get('/presensi/{id}/batalkanPerizinan',[PresensiController::class,'batalkanPerizinan']);

    //konfigurasi
    Route::get('/konfigurasi/lokasiKantor', [KonfigurasiController::class, 'lokasiKantor']);
    Route::post('/konfigurasi/updateLokasiKantor', [KonfigurasiController::class, 'updateLokasiKantor']);

});

//Session agar karyawan tetap login
Route::middleware(['auth:karyawan'])-> group(function () {
    Route::get('/dashboard', [DashboardController::class, 'home']);
    Route::get('/logoutrequest', [AuthController::class,'logoutrequest']);

    //presensi
    Route::get('/presensi/create', [PresensiController::class,'create']);
    Route::post('presensi/store', [PresensiController::class,'store']);

    //edit profile
    Route::get('/editProfile', [PresensiController::class,'editProfile']);
    Route::post('/presensi/{nik}/updateProfile', [PresensiController::class,'updateProfile']);

    //histori
    Route::get('/presensi/histori', [PresensiController::class,'histori']);
    Route::post('/getHistori', [PresensiController::class,'getHistori']);

    //izin
    Route::get('/presensi/izin', [PresensiController::class,'izin']);
    Route::get('/presensi/pengajuanIzin', [PresensiController::class,'pengajuanIzin']);
    Route::post('/presensi/storeIzin', [PresensiController::class,'storeIzin']);
    Route::post('/presensi/cekPengajuanIzin',[PresensiController::class,'cekPengajuanIzin']);

});