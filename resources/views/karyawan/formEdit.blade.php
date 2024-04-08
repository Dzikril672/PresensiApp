<form action="/karyawan/{{ $karyawan->nik }}/updateProses" method="POST" id="formEditKaryawan" enctype="multipart/form-data">
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
                    <input type="text" readonly value="{{ $karyawan -> nik }}" class="form-control" placeholder="NIK" name="nik" id="nik">
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
                    <input type="text" value="{{ $karyawan -> nama_lengkap }}" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" id="nama_lengkap">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                        stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                        class="icon icon-tabler icons-tabler-outline icon-tabler-id-badge-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7 12h3v4h-3z" />
                            <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" />
                            <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                            <path d="M14 16h2" />
                            <path d="M14 12h4" />
                    </svg>
                </span>
                    <input type="text" value="{{ $karyawan -> jabatan }}" class="form-control" placeholder="Jabatan" name="jabatan" id="jabatan">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg>
                </span>
                    <input type="text" value="{{ $karyawan -> no_hp }}" class="form-control" placeholder="No. Handphone" name="no_hp" id="no_hp">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <select name="kode_departemen" id="kode_departemen" class="form-select">
                <option value="">Departemen</option>
                @foreach($departemen as $item)
                    <option {{ $karyawan -> kode_departemen == $item -> kode_departemen ? 'selected' : ''}} 
                        value="{{ $item -> kode_departemen }}">
                            {{ $item -> nama_departemen }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="form-label">Photo Profile</div>
            <input type="file" class="form-control" name="foto" id="foto">
            <input type="hidden" name="foto_lama" id="foto_lama" value="{{ $karyawan -> foto }}">
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