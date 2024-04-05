@extends('layouts.admin.tabler')

@section('content')

<!-- header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
              Halaman
            </div>
            <h2 class="page-title">
              Data Karyawan
            </h2>
          </div>
        </div>
    </div>
</div>

<!-- body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>jabatan</th>
                                    <th>no Handphone</th>
                                    <th>Foto</th>
                                    <th>Departemen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($karyawan as $item)
                                    @php
                                        $path = Storage::url('uploads/karyawan/'. $item -> foto);
                                    @endphp
                                    <tr>
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{$item -> nik}}</td>
                                        <td>{{$item -> nama_lengkap}}</td>
                                        <td>{{$item -> jabatan}}</td>
                                        <td>{{$item -> no_hp}}</td>
                                        <td>
                                            @if(!empty ($item->foto))
                                                <img src="{{ url($path) }}" class="avatar" alt="profil">
                                            @else
                                                <img src="assets/img/sample/avatar/avatar1.jpg" class="avatar" alt="profil">
                                            @endif
                                        </td>
                                        <td>{{$item -> nama_departemen}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection