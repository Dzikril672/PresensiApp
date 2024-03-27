<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    //intent ke halaman presensi
    public function create(){

        $hariIni = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariIni)->where('nik', $nik)->count();

        return view('presensi.create', compact('cek'));
    }

    //fungsi untuk mengambil data yang dikirim dari halaman presensi dan akan diupload ke database
    public function store(Request $request){

        //pengambilan data
        $nik = Auth::guard( 'karyawan') ->user()->nik; //mengambil data user yang login
        $tgl_presensi = date("Y-m-d"); //mengambil data tanggal hari ini
        $jam = date("H:i:s"); //mengambil data jam saat ini
        $lokasi = $request ->lokasi; // mengambil lokasi user saat ini dari peta pada halaman presensi
        $image = $request ->image; // mengambil gambar user dari webcam pada halaman presensi

        //pembagian data lokasi
        $lokasiBagi = explode(",", $lokasi); //membagi lat dan long lokasi user
        $latUser = $lokasiBagi[0];
        $lonUser = $lokasiBagi[1];
        $latKantor = -6.180005585927644;
        $lonKantor = 106.70907087198061;

        //proses menghitung jarak
        $jarak = $this -> distance($latKantor, $lonKantor, $latUser, $lonUser);
        $radius = round($jarak["meters"]);

        //cek ketersediaan data
        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();
        if($cek > 0){
            $ket = "out";
        }else{
            $ket = "in";
        }

        //proses untuk image atau capture gambar
        $folderPath = "public/uploads/absensi"; //url folder tempat menyimpan data gambar
        $formatName = $nik."-".$tgl_presensi."-".$ket; //format penamaan file gambar
        $imageCode = explode(";base64", $image); //.code gambar dalam base64 yang dicapture
        $imageDecode = base64_decode($imageCode[1]);
        $fileName = $formatName.".png"; //nama file disimpan dengan ekstensi file .png
        $file = $folderPath . $fileName; //url file yang akan diupload

        //proses untuk data yang akan dikirim ketika absen pulang (update)
        if($radius > 60){
            echo "error|Maaf Anda Berada Di Luar Radius \n Jarak Anda " .$radius." meter dari kantor|radius";
        } else{
            if($cek > 0){
                $data_pulang = [
                    'jam_keluar' => $jam,
                    'foto_keluar' => $fileName,
                    'lokasi_keluar'=> $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if($update){
                    Storage::put($file, $imageDecode);
                    echo "success|Terima Kasih, Hati-hati Di Jalan|out";
                }else{
                    echo "error|Maaf Gagal Absen, Silahkan Ulangi|out";
                }
            } else {
                //proses untuk data yang akan dikirim ketika absen masuk (insert)
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_masuk' => $jam,
                    'foto_masuk' => $fileName,
                    'lokasi_masuk' => $lokasi
                ];

                //fungsi untuk menyimpan data ke tabel presensi dari variabel $data
                $simpan = DB::table('presensi')->insert($data);
                if($simpan){
                    Storage::put($file, $imageDecode);
                    echo "success|Terima Kasih, Selamat Bekerja|in";
                }else{
                    echo "error|Maaf Gagal Absen, Silahkan Ulangi|in";
                }
            }
        }
    }

    //menghitung jarak koordinat antara posisi kantor yang ditentukan dengan koordinat user
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

}
