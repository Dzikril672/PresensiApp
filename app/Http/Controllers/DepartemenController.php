<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DepartemenController extends Controller
{
    public function index(Request $request){

        $nama_departemen = $request ->nama_departemen;
        $query = Departemen::query();
        $query -> select('*');

        if($nama_departemen != ''){
            $query -> where('nama_departemen','like','%'.$nama_departemen.'%');
        }

        $departemen = $query -> get();

        // $departemen = DB::table("departemen")
        // ->orderBy('kode_departemen')    
        // ->get();

        return view("departemen.index", compact('departemen'));
    }

    public function store(Request $request){
        $kode_departemen = $request->kode_departemen;
        $nama_departemen = $request->nama_departemen1;

        $data = [
            'kode_departemen' => $kode_departemen,
            'nama_departemen' => $nama_departemen
        ];

        $cek = DB::table('departemen')->where('kode_departemen', $kode_departemen)->count();
        if($cek > 0){
            return Redirect::back()->with(['success' => 'Data dengan kode '. $kode_departemen . ' sudah ada']);
        }

        $simpan = DB::table('departemen')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function editForm(Request $request){
        $kode_departemen = $request ->kode_departemen;

        $departemen = DB::table('departemen')
            ->where('kode_departemen', $kode_departemen)
            ->first();

        return view('departemen.formEdit', compact('departemen'));
    }

    public function updateProses($kode_departemen, Request $request){
        $nama_departemen = $request ->nama_departemen;

        $data = [
            'nama_departemen' => $nama_departemen
        ];

        $update = DB::table('departemen')
            ->where('kode_departemen', $kode_departemen)
            ->update($data);

        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function deleteProses($kode_departemen){
        $delete = DB::table('departemen')->where('kode_departemen', $kode_departemen)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
