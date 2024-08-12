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
            font-size: 10px;
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
<body class="A4 landscape">


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
                    REKAP PRESENSI ASISTEN <br>
                    PERIODE {{ strtoupper ($namaBulan[$bulan])}} {{ $tahun }} <br>
                    INFORMATION TECHNOLOGY CERTIFICATION CENTER <br>
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

    <table class="tabelPresensi">
        <tr>
            <th rowspan="2">NIK</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">Hadir</th>
            <th rowspan="2">Terlambat</th>
        </tr>

        <tr>
            <?php
                for($i=1; $i<=31; $i++){
            ?>
                    <th> {{ $i }} </th>    
            <?php
                }
            ?>
        </tr>

        @foreach($rekap as $item)
            <tr>
                <td>{{ $item -> nik }}</td>
                <td>{{ $item -> nama_lengkap }}</td>

                <?php
                    $totalKehadiran = 0;
                    $totalTerlambat = 0;
                    for($i=1; $i<=31; $i++){
                        $tgl = "tgl_".$i;
                        if(empty($item -> $tgl)){
                            $kehadiran = ['', ''];
                        } else {
                            $kehadiran = explode("-", $item -> $tgl);
                            $totalKehadiran += 1 ;

                            if($kehadiran[0] > '07:00:00'){
                                $totalTerlambat += 1;
                            }
                        }
                ?>
                        <td>
                            <span style="color: {{ $kehadiran[0] > '07:00:00' ? 'red' : '' }}">{{ $kehadiran[0] }}</span>
                            <span style="color: {{ $kehadiran[1] < '17:00:00' ? 'red' : '' }}">{{ $kehadiran[1] }}</span>
                        </td>
    
                <?php
                    }
                ?>

                <td>{{ $totalKehadiran }}</td>
                <td>{{ $totalTerlambat }}</td>
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
                <u>Muhammad Zaid Al Khair</u><br>
                <i><b>Koordinator Laboratorium</b></i>  
            </td>
            <td style="text-align: center; vertical-align: bottom;" height="120px">
                <u>Hendra Jatnika</u><br>
                <i><b>Kepala Laboratorium</b></i>  
            </td>  
        </tr>
        
    </table>

  </section>

</body>

</html>