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

//Session untuk login
Route::middleware(['guest:karyawan']) -> group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    
    Route::post('/loginrequest', [AuthController::class, 'loginrequest']);
});

//Session agar tetap login
Route::middleware(['auth:karyawan'])-> group(function () {
    Route::get('/dashboard', [DashboardController::class, 'home']);
    Route::get('/logoutrequest', [AuthController::class,'logoutrequest']);

    //presensi
    Route::get('/presensi/create', [PresensiController::class,'create']);
});

