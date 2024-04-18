<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
    <style>
        @page { 
            size: A4 
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            font-weight: bold;
        }

        .tabelKaryawan {
            margin-top: 40px;
        }

        .tabelKaryawan td {
            padding: 3px;
        }

        .tabelPresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelPresensi tr th {
            border: 1px solid black;
            padding: 5px;
            background-color: aliceblue;
        }

        .tabelPresensi tr td {
            border: 1px solid black;
            padding: 5px;
            font-size: 12px;
        }

        .foto {
            width: 40px;
            height: 40px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

@php
    function selisih($jam_masuk, $jam_keluar){
        list($h, $m, $s) = explode(":", $jam_masuk);
        $dtAwal = mktime($h, $m, $s, "1", "1", "1");
        list($h, $m, $s) = explode(":", $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode(".", $totalmenit / 60);
        $sisamenit = ($totalmenit / 60) - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0]." jam ";
        return $jml_jam . ": " . round($sisamenit2)." menit";
    }
@endphp

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%" >
        <tr>
            <td style="width: 30px;">
                <img src="{{ asset('assets/img/kop-logo.png')}}" width="100" height="100" alt="logo">
            </td>
            <td>
                <span id="title">
                    LAPORAN PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper ($namaBulan[$bulan])}} {{ $tahun }} <br>
                    SEIC LABORATORY <br>
                </span>
                <span>
                    <i>
                        Menara PLN, Jl. Lkr. Luar Barat Lantai 2, RT.1/RW.1, Duri Kosambi, Kecamatan Cengkareng, Kota Jakarta Barat, 
                        Daerah Khusus Ibukota Jakarta. 11750
                    </i>
                </span>
            </td>
        </tr>
    </table>

    <table class="tabelKaryawan" >
        <tr>
            <td rowspan="6" style="padding-top: 8px;">
                @php
                    $path = Storage::url('uploads/karyawan/'. $karyawan->foto);
                @endphp
                <img src="{{ url ($path) }}" alt="foto" width="110px" height="130px">
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: </td>
            <td>{{ $karyawan -> nik }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: </td>
            <td>{{ $karyawan -> nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: </td>
            <td>{{ $karyawan -> jabatan }}</td>
        </tr>
        <tr>
            <td>Departemen</td>
            <td>: </td>
            <td>{{ $karyawan -> nama_departemen }}</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>: </td>
            <td>{{ $karyawan -> no_hp }}</td>
        </tr>
    </table>

    <table class="tabelPresensi">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>NIK</th>
            <th>Jam Masuk</th>
            <th>Foto Masuk</th>
            <th>Jam Keluar</th>
            <th>Foto Keluar</th>
            <th>Keterangan</th>
            <th>Jam Kerja</th>
        </tr>

        @foreach($presensi as $item)
            @php
                $path_in = Storage::url('uploads/absensi/'. $item->foto_masuk);
                $path_out = Storage::url('uploads/absensi/'. $item->foto_keluar);
            @endphp

            <tr>
                <td>{{ $loop -> iteration }}</td>
                <td>{{ date("d-m-Y", strtotime($item -> tgl_presensi)) }}</td>
                <td>{{ $item -> nik }}</td>
                <td>{{ $item -> jam_masuk }}</td>
                <td><img src="{{ url($path_in)}}" alt="foto_masuk" class="foto"></td>
                <td>{{ $item -> jam_keluar != null ? $item -> jam_keluar : 'Belum Absen' }}</td>
                <td>
                    @if($item -> jam_keluar != null)
                        <img src="{{url($path_out)}}" alt="foto_keluar" class="foto">
                    @else
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                            stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                            class="icon icon-tabler icons-tabler-outline icon-tabler-hourglass-high">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6.5 7h11" />
                                <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                                <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                        </svg>
                        <!-- <span class="badge bg-danger"> Belum Absen </span> -->
                    @endif
                </td>
                <td>
                    @if ($item -> jam_masuk >= '07:00')
                        @php
                            $jamTerlambat = selisih('07:00:00', $item -> jam_masuk);
                        @endphp
                        <span>Terlambat <br>
                        {{ $jamTerlambat }}</span>
                    @else
                        <span>Tepat Waktu</span>
                    @endif
                </td>
                <td>
                    @if ($item -> jam_keluar != null)
                        @php
                            $jamKerja = selisih($item -> jam_masuk, $item -> jam_keluar);
                        @endphp
                    @else
                        @php
                            $jamKerja = '0 jam : 0 menit';
                        @endphp
                    @endif
                    {{ $jamKerja }}
                </td>
            </tr>
        @endforeach
    </table>

    <table width="100%" style="margin-top: 30px;">
        <tr>
            <td></td>
            <td style="text-align: center;">Jakarta, {{ date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: bottom;" height="120px">
                <u>Daeng Dziha</u><br>
                <i><b>Koordinator Laboratorium</b></i>  
            </td>
            <td style="text-align: center; vertical-align: bottom;" height="120px">
                <u>Dzikril Hakim</u><br>
                <i><b>Kepala Laboratorium</b></i>  
            </td>  
        </tr>
        
    </table>

  </section>

</body>

</html>