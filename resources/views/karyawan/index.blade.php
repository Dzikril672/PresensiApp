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
                        <div class="row">
                            <div class="col-12">
                                <form action="/admin/karyawan" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" 
                                                    placeholder="Nama Karyawan" value="{{ Request('nama_karyawan') }}">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <select name="kode_departemen" id="kode_departemen" class="form-select">
                                                    <option value="">Departemen</option>
                                                    @foreach($departemen as $item)
                                                        <option {{ Request ('kode_departemen') == $item -> kode_departemen ? 'selected' : ''}} 
                                                            value="{{ $item -> kode_departemen }}">
                                                                {{ $item -> nama_departemen }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  
                                                        fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                                                        stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                            <path d="M21 21l-6 -6" />
                                                    </svg>
                                                    cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-12">
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
                                                <td>{{$loop -> iteration + $karyawan->firstItem()-1 }}</td>
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

                        {{$karyawan -> links('vendor.pagination.bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection