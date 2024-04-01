@if($histori-> isEmpty())
    <div class="alert alert-warning">
        <p> Data Tidak Ada </p>
    </div>
@endif

@foreach ($histori as $item)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('uploads/absensi/'.$item -> foto_masuk);
                @endphp

                <img src="{{url($path)}}" alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date("d-m-Y", strtotime($item->tgl_presensi)) }}</b>
                        <br>
                    </div>
                    <span class="badge {{$item -> jam_masuk <= "07:00" ? "badge-success" : "badge-primary" }}">{{$item -> jam_masuk}}</span>
                    <span class="badge badge-danger">{{$item -> jam_keluar}}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach