<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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

        //lokasi ITPLN
        // $latKantor = -6.180005585927644;
        // $lonKantor = 106.70907087198061;

        //lokasi kantor jamsostek
        $latKantor = -6.234762699996218;
        $lonKantor = 106.82150100000007;

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
        $folderPath = "public/uploads/absensi/"; //url folder tempat menyimpan data gambar
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

    public function editProfile(){
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        return view('presensi.editprofile', compact('karyawan'));
    }

    public function updateProfile(Request $request){

        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);

        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        if($request->hasFile('foto')){
            $foto = $nik."-profile.".$request -> file('foto') -> getClientOriginalExtension();
        } else {
            $foto = $karyawan -> foto;
        }
        
        if(empty($request -> password)){
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp'=> $no_hp,
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp'=> $no_hp,
                'foto' => $foto,
                'password'=> $password
                
            ];
        }

        //update foto profil
        $update = DB::table('karyawan')->where('nik', $nik) -> update($data);
        if($update){
            if($request -> hasFile('foto')){
                $folderPath = "public/uploads/karyawan/";
                $request -> file('foto') -> storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        }else{
            return Redirect::back()->with(['error'=> 'Data Gagal Diupdate']);
        }
    }

    public function histori(){

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
            "Desember"
        ];

        return view('presensi.histori', compact('namaBulan'));
    }

    public function getHistori(Request $request){
        
        $nik = Auth::guard('karyawan')->user()->nik;
        $bulan = $request -> bulan;
        $tahun = $request ->tahun;

        $histori = DB::table('presensi')
        ->whereRaw('MONTH(tgl_presensi)="' .$bulan. '"')
        ->whereRaw('YEAR(tgl_presensi)="' .$tahun. '"')
        ->where('nik', $nik)
        ->orderBy('tgl_presensi')
        ->get();

        return view('presensi.getHistori', compact('histori'));
    }

    public function izin(){
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataIzin = DB::table('pengajuan_izin')->where('nik', $nik)->get();

        return view('presensi.izin', compact('dataIzin'));
    }

    public function pengajuanIzin(){
        
        return view('presensi.pengajuanIzin');
    }

    public function storeIzin(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request ->tanggalIzin;
        $status = $request -> status;
        $keterangan = $request -> keterangan;

        $data = [
            'nik'=> $nik,
            'tgl_izin'=> $tgl_izin,
            'status'=> $status,
            'keterangan'=> $keterangan
        ]; 

        $simpan = DB::table('pengajuan_izin')->insert($data);
        if($simpan){
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Diajukan']);
        } else{
            return redirect('/presensi/izin')->with(['error'=> 'Data gagal Diajukan']);
        }
    }

    public function monitoring(){
        return view('presensi.monitoring');
    }

    public function getPresensi(Request $request){
        $tanggal = $request ->tanggal;

        $presensi = DB::table('presensi')
            ->select('presensi.*', 'nama_lengkap', 'nama_departemen')
            ->join('karyawan', 'presensi.nik','=','karyawan.nik')
            ->join('departemen','karyawan.kode_departemen','=','departemen.kode_departemen')
            ->where('tgl_presensi', $tanggal)
            ->get();

        return view('presensi.getPresensi', compact('presensi'));
    }

    public function tampilPeta(Request $request){
        $id = $request -> id;

        $presensi = DB::table('presensi')
            ->join('karyawan','presensi.nik','=','karyawan.nik')
            ->where('id', $id)
            ->first();
        
        return view('presensi.tampilPeta', compact('presensi'));
        
    }

    public function laporanPresensi(){

        $karyawan = DB::table('karyawan')
            ->orderBy('nama_lengkap')
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
            "Desember"
        ];

        return view('presensi.laporanPresensi', compact('namaBulan', 'karyawan'));
    }

    public function cetakLaporan(Request $request){
        $nik = $request -> nik;
        $bulan = $request ->bulan;
        $tahun = $request ->tahun;

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
            "Desember"
        ];

        $karyawan = DB::table('karyawan')
            ->join('departemen','karyawan.kode_departemen','=','departemen.kode_departemen')
            ->where('nik', $nik)
            ->first();
        
        $presensi = DB::table('presensi')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' .$bulan. '"')
            ->whereRaw('YEAR(tgl_presensi)="' .$tahun. '"')
            ->orderBy('tgl_presensi')
            ->get();

        return view('presensi.cetakLaporan', compact('bulan','tahun', 'namaBulan', 'karyawan', 'presensi'));
    }

}
