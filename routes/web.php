<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

});



