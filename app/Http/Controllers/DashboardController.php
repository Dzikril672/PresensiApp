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
        $bulanIni = date("m") * 1; //mengambil data bulan berjalan agar dapat dibaca data nama bulan (dalam bentuk angka)
        $tahunIni = date("Y");
        $historiBulanIni = DB::table('presensi')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="'.$bulanIni.'"')
            ->whereRaw('YEAR(tgl_presensi)="'.$tahunIni.'"')
            ->orderBy('tgl_presensi')
            ->get();
        
        //mengganti data bulan (angka) menjadi nama bulan
        $namaBulan = [
            "",
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"];
        
        $rekapPresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_masuk > "08 :30", 1, 0)) as jmlTelat')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulanIni.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahunIni.'"')
        ->first();

        $leaderboards = DB::table('presensi')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->where('tgl_presensi', $hariIni)
        ->orderBy('jam_masuk')
        ->get();
        
        return view('dashboard.dashboard', compact('presensiHariIni', 'historiBulanIni', 
            'namaBulan', 'bulanIni', 'tahunIni','rekapPresensi', 'leaderboards'));
    }
}
