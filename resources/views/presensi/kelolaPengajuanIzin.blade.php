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
                                <td>{{ $loop -> iteration }}</td>
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
                                        <a href="#" class="btn btn-sm btn-primary w-100" id="aksi" id_perizinan="{{ $item -> id }}">
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
            $("#aksi").click(function(e){
                e.preventDefault();

                var id_perizinan = $(this).attr("id_perizinan");
                $("#perizinan_form").val(id_perizinan);
                $("#modal-perizinan").modal('show');
            });
        });
    </script>
@endpush