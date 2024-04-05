<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(){

        $karyawan = DB::table("karyawan")
            ->join("departemen","karyawan.kode_departemen","=","departemen.kode_departemen")
            ->orderBy('nama_lengkap')
            ->get();    

        return view('karyawan.index', compact('karyawan'));
    }
}
