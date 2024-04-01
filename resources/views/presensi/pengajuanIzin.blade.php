@extends('layouts.presensi');

@section('header')

<!-- link css untuk form datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

<!-- App Header -->
<div class="appHeader bg-success text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Form Pengajuan Izin</div>
    <div class="right"></div>
</div>
<!-- App Header -->
@endsection

@section('content')
    <div class="row" style="margin-top: 70px;">
        <div class="col">
            <form action="/presensi/storeIzin" method="POST" id="formIzin">
                @csrf
                <div class="form-group">
                    <input name="tanggalIzin" id="tanggalIzin" type="text" class="form-control datepicker" placeholder="Tanggal">
                </div>
            
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="">Izin / Sakit</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block"> Kirim </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        var currYear = (new Date()).getFullYear();
        $(document).ready(function() {
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd"    
            });

            $("#formIzin").submit(function(){
                var tgl_izin = $("#tanggalIzin").val();
                var status = $("#status").val();
                var keterangan = $("#keterangan").val();

                if(tgl_izin == ""){
                    Swal.fire({
                        title: 'Oops',
                        text: 'Tanggal Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    });
                    return false;
                } else if(status == ""){
                    Swal.fire({
                        title: 'Oops',
                        text: 'Status Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    });
                    return false;
                } else if(keterangan == ""){
                    Swal.fire({
                        title: 'Oops',
                        text: 'Keterangan Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    });
                    return false;
                }
            });
        });
    </script>
@endpush