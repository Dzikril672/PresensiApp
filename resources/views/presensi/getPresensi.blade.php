<!-- menghitung selisih jam keterlambatan -->
@php
 function selisih($jam_masuk, $jam_keluar){
    list($h, $m, $s) = explode(":", $jam_masuk);
    $dtAwal = mktime($h, $m, $s, "1", "1", "1");
    list($h, $m, $s) = explode(":", $jam_keluar);
    $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
    $dtSelisih = $dtAkhir - $dtAwal;
    $totalmenit = $dtSelisih / 60;
    $jam = explode(".", $totalmenit / 60);
    $sisamenit = ($totalmenit / 60) - $jam[0];
    $sisamenit2 = $sisamenit * 60;
    $jml_jam = $jam[0]." jam ";
    return $jml_jam . ": " . round($sisamenit2)." menit";
}
@endphp

@foreach($presensi as $item)
    @php
        $foto_masuk = Storage::url('uploads/absensi/'.$item -> foto_masuk);
        $foto_keluar = Storage::url('uploads/absensi/'.$item -> foto_keluar);
    @endphp
    <tr>
        <td>{{ $loop -> iteration }}</td>
        <td>{{ $item -> nik }}</td>
        <td>{{ $item -> nama_lengkap }}</td>
        <td>{{ $item -> nama_departemen }}</td>
        <td>{{ $item -> jam_masuk }}</td>

        <td>
            <img src="{{url($foto_masuk)}}" alt="image" class="avatar"> 
        </td>

        <td>{!! $item -> jam_keluar != null ? $item -> jam_keluar : '<span class="badge bg-danger" style="color: white;">Belum Absen</span> '!!}</td>

        <td>
            @if($item -> jam_keluar != null)
                <img src="{{url($foto_keluar)}}" alt="image" class="avatar">
            @else
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                    stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                    class="icon icon-tabler icons-tabler-outline icon-tabler-hourglass-high">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6.5 7h11" />
                        <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                        <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                </svg>
                <!-- <span class="badge bg-danger"> Belum Absen </span> -->
            @endif
        </td>

        <!-- pengondisian keterlambatan -->
        <td>
            @if ($item -> jam_masuk >= '07:00')
                @php
                    $jamTerlambat = selisih('07:00:00', $item -> jam_masuk);
                @endphp
                <span class="badge bg-danger" style="color: white;" >Terlambat <br>
                {{ $jamTerlambat }}</span>
            @else
                <span class="badge bg-success" style="color: white;">Tepat Waktu</span>
            @endif
        </td>

        <td>
            <a href="#" class="btn btn-primary tampilPeta" id="{{ $item -> id }}">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                    stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                    class="icon icon-tabler icons-tabler-outline icon-tabler-map-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                        <path d="M9 4v13" />
                        <path d="M15 7v5.5" />
                        <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                        <path d="M19 18v.01" />
                </svg>
            </a>
        </td>
    </tr>
@endforeach


<script>
    $(function(){
        $(".tampilPeta").click(function(){
            var id = $(this).attr("id");
            
            $.ajax({
                type : 'POST',
                url : '/tampilPeta',
                data : {
                    _token : "{{ csrf_token() }}",
                    id : id
                },
                cache : false,
                success : function(respond){
                    $("#loadPeta").html(respond);
                }
            });

            $("#modal-tampilPeta").modal("show");
        });
    });
</script>
