@extends('layouts.presensi')

<style>
    .webcam,
    .webcam video {
        display: inline-block;
        width: 100% !important;
        height: auto !important;
        margin: auto;
        border-radius: 15px;
    }

    #map { 
        height: 280px;
    }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-success text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">E-Presensi SEIC</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <div class="row" style="margin-top: 70px;">
        <div class="col">
            <input type="hidden" id="lokasi">
            <div class="webcam">

            </div>   
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            @if($cek > 0)
                <button id="capture" class="btn btn-danger btn-block">
                <ion-icon name="camera-outline"></ion-icon>
                    Absen Pulang
                </button>
            @else
                <button id="capture" class="btn btn-success btn-block">
                <ion-icon name="camera-outline"></ion-icon>
                    Absen Masuk
                </button> 
            @endif
             
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map" style="position: relative; margin-bottom: 4rem; outline-style: dashed;"></div>
        </div>
    </div>
    <audio id="notif_masuk">
        <source src="{{asset('assets/sounds/notif_masuk.mp3')}}" type="audio/mpeg">
</audio>
    <audio id="notif_keluar">
        <source src="{{asset('assets/sounds/notif_keluar.mp3')}}" type="audio/mpeg">
    </audio>
    <audio id="radius">
        <source src="{{asset('assets/sounds/radius.mp3')}}" type="audio/mpeg">
    </audio>
@endsection

@push('myscript')
    <script>

        var notif_masuk = document.getElementById('notif_masuk');
        var notif_keluar = document.getElementById('notif_keluar');
        var radius = document.getElementById('radius');

        Webcam.set({
            height : 480,
            width : 640,
            image_format : 'jpeg',
            jpeg_quality : 80
        });

        Webcam.attach('.webcam');

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        //fungsi jika sukses mendapatkan posisi pengguna
        function successCallback(position){
            lokasi.value = position.coords.latitude+", "+position.coords.longitude;

            var lokasi_kantor = "{{ $lokasi_kantor -> lokasi_kantor }}";
            var pecahLokasi = lokasi_kantor.split(',');
            var lat_kantor = pecahLokasi[0];
            var long_kantor = pecahLokasi[1];
            var radius = "{{ $lokasi_kantor -> radius }}";

            //mengatur tampilan maps berdasarkan posisi pengguna
            var map = L.map('map').setView([
                position.coords.latitude, 
                position.coords.longitude], 
                17 //default zoom tampilan awal
            );

            //layer tampilan maps
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 25,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            
            //mengatur titik penanda berdasarkan koordinat user
            var marker = L.marker([
                position.coords.latitude, 
                position.coords.longitude
            ]).addTo(map);
            
            //mengatur titik koordinat kantor dan radiusnya
            var circle = L.circle([
                //untuk lokasi ITPLN
                // -6.180005585927644, 
                // 106.70907087198061],
                
                //untuk lokasi kantor jamsostek
                lat_kantor, 
                long_kantor],
            {
                color: 'blue',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius:  radius//mengatur jarak radius lingkaran
            }).addTo(map);
        }

        function errorCallback(){
            //to do
        }

        //fungsi yang dijalankan ketika tombol absen (capture) diklik
        $("#capture").click(function(e){

            //mengambil capture gambar
            Webcam.snap(function(uri){
                image = uri;
            });

            //mengambil titik koordinat lokasi
            var lokasi = $("#lokasi").val();

            //mengirim data dengan fungsi ajax dalam jquery
            $.ajax({
                type:'POST',            //tipenya post untuk mengirim data
                url: '/presensi/store', //metode yang dieksekusi di PresensiController
                data:{                  //data yang dikirim
                    _token : "{{csrf_token()}}",
                    image : image,
                    lokasi : lokasi
                },
                cache:false,
                success:function(respond){ //respon jika sukses
                    var status = respond.split("|")
                    if(status[0] == "success"){
                        if(status[2] == "in"){
                            notif_masuk.play();
                        } else {
                            notif_keluar.play();
                        }
                        Swal.fire({
                            title: 'Berhasil Melakukan Absen !',
                            text: status[1],
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        })
                        setTimeout("location.href='/dashboard'", 3000);
                    } else {
                        if(status[2] == "radius"){
                            radius.play();
                        }
                        Swal.fire({
                            title: 'Gagal Melakukan Absen !',
                            text: status[1],
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            });
        });

    </script>
@endpush