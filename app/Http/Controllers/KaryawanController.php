<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request){
        $nik = $request -> nik;
        $nama_lengkap = $request -> nama_lengkap;
        $jabatan = $request -> jabatan;
        $no_hp = $request -> no_hp;
        $kode_departemen = $request -> kode_departemen;
        $password = Hash::make('12345');

        //cek data karyawan
        // $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        //cek apakah karyawan sudah punya foto atau belum
        if($request->hasFile('foto')){
            $foto = $nik."-profile.".$request -> file('foto') -> getClientOriginalExtension();
        } else {
            $foto = null;
        }

        //data yang akan ditambah
        try{
            $data = [
                'nik'=> $nik,
                'nama_lengkap'=> $nama_lengkap,
                'jabatan'=> $jabatan,
                'no_hp'=> $no_hp,
                'kode_departemen'=> $kode_departemen,
                'foto' => $foto,
                'password' => $password
            ];

            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if($request -> hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $request -> file('foto') -> storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return Redirect::back()->with(['warning'=> 'Data Gagal Disimpan']);
        }
    }

    public function editForm (Request $request) {
        $nik = $request -> nik;

        $departemen = DB::table('departemen')-> get();
        $karyawan = DB::table('karyawan')
            ->where('nik', $nik)
            ->first();

        return view('karyawan.formEdit', compact('departemen', 'karyawan'));
    }

    public function updateProses($nik, Request $request) {
        $nik = $request -> nik;
        $nama_lengkap = $request -> nama_lengkap;
        $jabatan = $request -> jabatan;
        $no_hp = $request -> no_hp;
        $kode_departemen = $request -> kode_departemen;
        $password = Hash::make('12345');
        $foto_lama = $request -> foto_lama;

        //cek data karyawan
        // $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        //cek apakah karyawan sudah punya foto atau belum
        if($request->hasFile('foto')){
            $foto = $nik."-profile.".$request -> file('foto') -> getClientOriginalExtension();
        } else {
            $foto = $foto_lama;
        }

        //data yang akan diupdate
        try{
            $data = [
                'nama_lengkap'=> $nama_lengkap,
                'jabatan'=> $jabatan,
                'no_hp'=> $no_hp,
                'kode_departemen'=> $kode_departemen,
                'foto' => $foto,
                'password' => $password
            ];

            $update = DB::table('karyawan')->where('nik', $nik)->update($data);
            if($update){
                if($request -> hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";

                    //hapus foto profil lama agar tidak duplikat
                    $folderPathLama = "public/uploads/karyawan/".$foto_lama;
                    Storage::delete($folderPathLama);

                    $request -> file('foto') -> storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return Redirect::back()->with(['warning'=> 'Data Gagal Diupdate']);
        }
    }

    public function deleteProses($nik){
        $delete = DB::table('karyawan')->where('nik', $nik)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
