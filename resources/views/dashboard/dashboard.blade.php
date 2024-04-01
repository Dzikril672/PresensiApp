@extends('layouts.presensi')

@section('content')

<!-- App Capsule -->
    <div id="appCapsule">
        <div class="section bg-success" id="user-section">
            <div id="user-detail">
                <div class="avatar">
                    @if(!empty(Auth::guard('karyawan') -> user() -> foto))
                        @php
                            $path = Storage::url('uploads/karyawan/'.Auth::guard('karyawan') -> user() -> foto);
                        @endphp
                        <img src="{{url($path)}}" alt="avatar" class="imaged w64 rounded" style="height: 70px;">
                    @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                    @endif
                </div>
                <div id="user-info">
                    <h2 id="user-name">{{Auth::guard('karyawan')->user()->nama_lengkap}}</h2>
                    <span id="user-role">{{Auth::guard('karyawan')->user()->jabatan}}</span>
                </div>
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="green" style="font-size: 40px;">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Profil</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="danger" style="font-size: 40px;">
                                    <ion-icon name="calendar-number"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Cuti</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="warning" style="font-size: 40px;">
                                    <ion-icon name="document-text"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Histori</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="orange" style="font-size: 40px;">
                                    <ion-icon name="location"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                Lokasi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="row">
                    <div class="col-6">
                        <div class="card gradasiblue">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="camera"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Masuk</h4>
                                        <span>{{ $presensiHariIni != null ? $presensiHariIni -> jam_masuk : "--:--" }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card gradasired">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="camera"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Pulang</h4>
                                        <span>{{ $presensiHariIni != null && $presensiHariIni -> jam_keluar != null ? $presensiHariIni -> jam_keluar : "--:--" }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="rekappresensi">
                <h3 style="font-family: Arial, Helvetica, sans-serif;">Rekap Presensi Bulan {{$namaBulan[$bulanIni]}} Tahun {{$tahunIni}}</h3>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 14px 10px !important;">
                                <span class="badge bg-danger" style="position: absolute; top: 3px; right: 10px; 
                                    font-size: smaller; z-index:999;">{{$rekapPresensi -> jmlhadir}}</span>
                                <ion-icon name="accessibility-outline" style="font-size: 1.5rem;" class="text-primary"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-family: Arial, Helvetica, sans-serif; font-weight:500;">Hadir</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 14px 10px !important;">
                                <span class="badge bg-danger" style="position: absolute; top: 3px; right: 10px; 
                                    font-size: smaller; z-index:999;">10</span>
                                <ion-icon name="newspaper-outline" style="font-size: 1.5rem;" class="text-success"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-family: Arial, Helvetica, sans-serif; font-weight:500;">Izin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 14px 10px !important;">
                                <span class="badge bg-danger" style="position: absolute; top: 3px; right: 10px; 
                                    font-size: smaller; z-index:999;">10</span>
                                <ion-icon name="medkit-outline" style="font-size: 1.5rem;" class="text-warning"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-family: Arial, Helvetica, sans-serif; font-weight:500;">Sakit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 14px 10px !important;">
                                <span class="badge bg-danger" style="position: absolute; top: 3px; right: 10px; 
                                    font-size: smaller; z-index:999;">{{$rekapPresensi -> jmlTelat}}</span>
                                <ion-icon name="alarm-outline" style="font-size: 1.5rem;" class="text-danger"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-family: Arial, Helvetica, sans-serif; font-weight:500;">Telat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="presencetab mt-2">
                <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                    <ul class="nav nav-tabs style1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                Bulan Ini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Leaderboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach($historiBulanIni as $item)
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>{{ date("d-m-Y", strtotime($item->tgl_presensi)) }}</div>
                                        <span class="badge badge-success">{{$presensiHariIni != null ? $item -> jam_masuk : 'Absen'}}</span>
                                        <span class="badge badge-danger">{{$presensiHariIni != null && $item->jam_keluar != null ? $item -> jam_keluar : 'Absen'}}</span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach($leaderboards as $item)
                                <li>
                                    <div class="item">
                                        @php
                                            $path = Storage::url('uploads/karyawan/'.$item -> foto);
                                        @endphp
                                        <img src="{{url($path)}}" alt="image" class="image">
                                        <div class="in">
                                            <div>{{substr($item->nama_lengkap, 0, 13)}}
                                                <br>
                                                <small class="text-muted">{{$item -> jabatan}}</small>
                                            </div>
                                            <span class="badge {{$item -> jam_masuk <= "07:00" ? "badge-success" : "badge-primary" }}">{{$item -> jam_masuk}}</span>
                                            <!-- <span class="badge badge-danger">{{$item -> jam_keluar}}</span> -->
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection