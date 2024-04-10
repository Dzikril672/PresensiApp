<style>
    #map { 
        height: 400px;
    }
</style>

<div id="map">

</div>

<script>
    //penentuan posisi absen user
    var lokasi = "{{ $presensi -> lokasi_masuk}}";
    var lokasiBagi = lokasi.split(",");
    var lat = lokasiBagi[0];
    var long = lokasiBagi[1];

    //menampilkan peta
    var map = L.map('map').setView([lat, long], 16);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 25,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    //menampilkan marker
    var marker = L.marker([lat, long]).addTo(map);

    //menampilkan lingkaran
    var circle = L.circle([
        //untuk lokasi ITPLN
        // -6.180005585927644, 
        // 106.70907087198061],
        
        //untuk lokasi kantor jamsostek
        -6.234762699996218, 
        106.82150100000007],
    {
        color: 'blue',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 50 //mengatur jarak radius lingkaran
    }).addTo(map);

    //menampilkan popup tulisan
    var popup = L.popup()
        .setLatLng([lat, long])
        .setContent("{{ $presensi -> nama_lengkap }}")
        .openOn(map);
</script>
