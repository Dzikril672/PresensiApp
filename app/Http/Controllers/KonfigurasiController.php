<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasiKantor(){
        $lokasi_kantor = DB::table('konfigurasi_lokasi')
            ->where('id', 1)
            ->first();

        return view('konfigurasi.lokasiKantor', compact('lokasi_kantor'));
    }

    public function updateLokasiKantor(Request $request){
        $lokasi_kantor = $request->lokasiKantor;
        $radius = $request->radius;

        $data = [
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
        ];

        $update = DB::table('konfigurasi_lokasi')->where('id', 1) -> update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        }else{
            return Redirect::back()->with(['warning'=> 'Data Gagal Diupdate']);
        }

    }
}
