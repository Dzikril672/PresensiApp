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

    <table class="tabelKaryawan">
        <tr>
            <td rowspan="6">
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
            <th>keterangan</th>
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
                <td><img src="{{ url($path_out)}}" alt="foto_keluar" class="foto"></td>
                <td>
                    @if ($item -> jam_masuk > '07:00')
                        <span class="badge bg-danger">Terlambat</span>
                    @else 
                        <span class="badge bg-success">Tepat Waktu</span>
                    @endif
                </td>
            </tr>

        @endforeach
    </table>

  </section>

</body>

</html>