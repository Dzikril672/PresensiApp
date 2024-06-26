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

        $rekapIzin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status ="i" , 1, 0)) as jmlIzin, SUM(IF(status ="s" , 1, 0)) as jmlSakit')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_izin)="'.$bulanIni.'"')
        ->whereRaw('YEAR(tgl_izin)="'.$tahunIni.'"')
        ->where('status_approved', 1)
        ->first();

        $leaderboards = DB::table('presensi')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->where('tgl_presensi', $hariIni)
        ->orderBy('jam_masuk')
        ->get();
        
        return view('dashboard.dashboard', compact('presensiHariIni', 'historiBulanIni', 
            'namaBulan', 'bulanIni', 'tahunIni','rekapPresensi', 'leaderboards', 'rekapIzin'));
    }

    public function dashboardAdmin(){

        $hariIni = date("Y-m-d");
        $rekapPresensi = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_masuk > "08 :30", 1, 0)) as jmlTelat')
            ->where('tgl_presensi', $hariIni)
            ->first();

        $rekapIzin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status ="i" , 1, 0)) as jmlIzin, SUM(IF(status ="s" , 1, 0)) as jmlSakit')
            ->where('tgl_izin', $hariIni)
            ->where('status_approved', 1)
            ->first();

        return view('dashboard.dashboardAdmin', compact('rekapPresensi', 'rekapIzin'));
    }
}
