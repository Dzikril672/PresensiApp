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
              Data Departemen
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
                                @if(Session::get('success'))
                                    <div class="alert alert-outline-success">
                                        {{Session::get('success')}}
                                    </div>
                                 @endif
                                @if(Session::get('warning'))
                                    <div class="alert alert-outline-warning">
                                        {{Session::get('warning')}}
                                    </div>
                                 @endif
                            </div>
                        </div>    

                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahDepartemen">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                        stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                    </svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/departemen" method="GET">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="form-group">
                                                <input type="text" name="nama_departemen" id="nama_departemen" class="form-control" 
                                                    placeholder="Departemen" value="{{ Request('nama_departemen') }}">
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
                                            <th>Kode Departemen</th>
                                            <th>Nama Departemen</th>
                                            
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                        @foreach($departemen as $item)
                                            <tr>
                                                <td>{{$loop -> iteration }}</td>
                                                <td>{{$item -> kode_departemen}}</td>
                                                <td>{{$item -> nama_departemen}}</td>

                                                <td>
                                                    <a href="#" class="edit btn btn-primary btn-sm" kode_departemen="{{ $item -> kode_departemen }}">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                                            stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                <path d="M16 5l3 3" />
                                                        </svg>
                                                    </a>

                                                    <form action="/departemen/{{ $item -> kode_departemen }}/deleteProses" method="POST">
                                                        @csrf

                                                        <!-- @method('DELETE') -->
                                                        <a class="btn btn-danger btn-sm konfirmasiDelete">
                                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                                                stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                    <path d="M4 7l16 0" />
                                                                    <path d="M10 11l0 6" />
                                                                    <path d="M14 11l0 6" />
                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
                                                        </a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal input departemen -->
<div class="modal modal-blur fade" id="modal-inputDepartemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Departemen</h5>   
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/departemen/store" method="POST" id="formTambahDepartemen">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                    stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                </svg>
                            </span>
                                <input type="text" value="" class="form-control" placeholder="Kode Departemen" name="kode_departemen" id="kode_departemen">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                </svg>
                            </span>
                                <input type="text" value="" class="form-control" placeholder="Nama Departemen" name="nama_departemen1" id="nama_departemen1">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>

            </form>
          </div>
        </div>
    </div>
</div>

<!-- Modal edit data Departemen -->
<div class="modal modal-blur fade" id="modal-editDepartemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Departemen</h5>   
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadEditForm">
            
          </div>
        </div>
    </div>
</div>

@endsection

@push('myscript')
    <script>
        $(function(){
            $("#btnTambahDepartemen").click(function(){
                $("#modal-inputDepartemen").modal("show");
            });

            $(".edit").click(function(){
                var kode_departemen = $(this).attr('kode_departemen');

                $.ajax({
                    type: 'POST',
                    url : '/departemen/editForm',
                    cache : false,
                    data : {
                        _token : "{{ csrf_token() }}",
                        kode_departemen : kode_departemen
                    },
                    success: function(respond){
                        $("#loadEditForm").html(respond);
                    }
                });

                $("#modal-editDepartemen").modal("show");
            });

            $(".konfirmasiDelete").click(function(e){
                //memilih form dari si button
                form = $(this).closest('form');

                e.preventDefault();
                Swal.fire({
                    title: "Konfirmasi Hapus Data",
                    showCancelButton: true,
                    confirmButtonText: "Delete"
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire("Deleted!", "", "success");
                    }
                });

            });

            $("#formTambahDepartemen").submit(function(){
                var kode_departemen = $("#kode_departemen").val();
                var nama_departemen = $("#nama_departemen1").val();

                if(kode_departemen == ""){
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Kode Departemen Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#kode_departemen").focus();
                    });
                    
                    return false;
                }
                else if(nama_departemen == ""){
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Departemen Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#nama_departemen1").focus();
                    });

                    return false;
                }
            });
        });
    </script>
@endpush