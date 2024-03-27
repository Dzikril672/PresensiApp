<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home(){

        //mengambil data waktu presensi
        $nik = Auth::guard('karyawan')->user()->nik;
        $hariIni = date("Y-m-d");
        $presensiHariIni = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariIni)->first();

        //mengambil data bulanan untuk rekap
        $bulanIni = date("m");
        $tahunIni = date("Y");
        $historiBulanIni = DB::table('presensi')->whereRaw('MONTH(tgl_presensi)="'.$bulanIni.'"')
            ->whereRaw('YEAR(tgl_presensi)="'.$tahunIni.'"')
            ->orderBy('tgl_presensi')
            ->get();

        return view('dashboard.dashboard', compact('presensiHariIni', 'historiBulanIni'));
    }
}
