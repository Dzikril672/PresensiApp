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
              Kelola Pengajuan Izin
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
                <form action="/presensi/kelolaPengajuanIzin" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none" 
                                        stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M7 14h.013" />
                                            <path d="M10.01 14h.005" />
                                            <path d="M13.01 14h.005" />
                                            <path d="M16.015 14h.005" />
                                            <path d="M13.015 17h.005" />
                                            <path d="M7.01 17h.005" />
                                            <path d="M10.01 17h.005" />
                                    </svg>
                                </span>
                                    <input type="text" value="{{ Request('dari') }}" class="form-control" placeholder="Dari" name="dari" id="dari">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none" 
                                        stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M7 14h.013" />
                                            <path d="M10.01 14h.005" />
                                            <path d="M13.01 14h.005" />
                                            <path d="M16.015 14h.005" />
                                            <path d="M13.015 17h.005" />
                                            <path d="M7.01 17h.005" />
                                            <path d="M10.01 17h.005" />
                                    </svg>
                                </span>
                                    <input type="text" value="{{ Request('sampai') }}" class="form-control" placeholder="Sampai" name="sampai" id="sampai">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
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
                                    <input type="text" value="{{ Request('nik') }}" class="form-control" placeholder="NIK" name="nik" id="nik">
                            </div>
                        </div>

                        <div class="col-3">
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
                                    <input type="text" value="{{ Request('nama_lengkap') }}" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" id="nama_lengkap">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group"> 
                                <select name="status_approved" id="status_approved" class="form-select">
                                    <option value="">Pilih Status Approval</option>
                                    <option value="0" {{ Request('status_approved') == 0 ? 'selected' : ''}} >Menunggu</option>
                                    <option value="1" {{ Request('status_approved') == 1 ? 'selected' : ''}} >Disetujui</option>
                                    <option value="2" {{ Request('status_approved') == 2 ? 'selected' : ''}} >Ditolak</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                    stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                    Cari Data
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Status Approval</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($dataIzinSakit as $item)
                            <tr>
                            <td>{{$loop -> iteration + $dataIzinSakit->firstItem()-1 }}</td>
                                <td>{{ date('d-m-Y', strtotime($item -> tgl_izin)) }}</td>
                                <td>{{ $item -> nik }}</td>
                                <td>{{ $item -> nama_lengkap }}</td>
                                <td>{{ $item -> jabatan }}</td>
                                <td>{{ $item -> status == "i" ? "Izin" : "Sakit" }}</td>
                                <td>{{ $item -> keterangan }}</td>
                                <td>
                                    @if($item -> status_approved == 1)
                                        <span class="badge bg-success" style="color: white;">Disetujui</span>
                                    @elseif($item -> status_approved == 2)
                                        <span class="badge bg-danger" style="color: white;">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning" style="color: white;">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item -> status_approved == 0)
                                        <a href="#" class="btn btn-sm btn-primary w-100 aksi" id_perizinan="{{ $item -> id }}">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  
                                                fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                                                stroke-linejoin="round"  
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                    <path d="M11 13l9 -9" />
                                                    <path d="M15 4h5v5" />
                                            </svg>
                                            Aksi
                                        </a>
                                    @else
                                        <a href="/presensi/{{ $item -> id}}/batalkanPerizinan" class="btn btn-sm btn-danger w-100" id="batalkan">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  
                                                fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                                                stroke-linejoin="round"  
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-circle-x">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M10 10l4 4m0 -4l-4 4" />
                                            </svg>
                                            Batalkan
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$dataIzinSakit -> links('vendor.pagination.bootstrap-5')}}
            </div>
        </div>
    </div>
</div>

<!-- Modal Tampil Kelola Pangajuan Izin -->
<div class="modal modal-blur fade" id="modal-perizinan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelola Pengajuan Izin</h5>   
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/presensi/approveIzin" method="post">
                @csrf
                    <input type="hidden" id="perizinan_form" name="perizinan_form">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group"> 
                                <select name="status_approved" id="status_approved" class="form-select">
                                    <option value="0">Pilih Tindakan</option>
                                    <option value="1">Disetujui</option>
                                    <option value="2">Ditolak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                        stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
                                    </svg>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('myscript')
    <script>
        $(function(){
            $("#dari , #sampai").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                format : 'yyyy-mm-dd'
            });

            $(document).on('click', '.aksi', function(e) {
                e.preventDefault();

                var id_perizinan = $(this).attr("id_perizinan");
                $("#perizinan_form").val(id_perizinan);
                $("#modal-perizinan").modal('show');
            });
        });
    </script>
@endpush