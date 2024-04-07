<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(Request $request){

        $query = Karyawan::query();
        $query -> select('karyawan.*', 'nama_departemen');
        $query -> join('departemen', 'karyawan.kode_departemen', '=','departemen.kode_departemen');
        $query -> orderBy('nama_lengkap');

        if(!empty($request-> nama_karyawan)){
            $query -> where('nama_lengkap', 'like', '%'. $request->nama_karyawan .'%');
        }
        
        if(!empty($request-> kode_departemen)){
            $query -> where('karyawan.kode_departemen', $request->kode_departemen);
        }

        $karyawan = $query -> paginate(10);

        $departemen = DB::table('departemen')-> get();

        return view('karyawan.index', compact('karyawan', 'departemen'));
    }
}
