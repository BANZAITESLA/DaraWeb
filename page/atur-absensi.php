<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php'); ?>
    <title>Pengaturan Absensi</title>
    <?php include_once('../component/script.php'); ?>
</head>

<body>
    <?php include_once('../component/functions.php'); ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Pengaturan Absensi</div>
        <div class="container-absen">
            <div class="box-item">
                <div style="font-size: 16px; font-weight:500;">Atur Hari Libur</div>
                <div class="head-box-item">
                    <div class="item-control-mp">
                        <label for="bulan"> Bulan</label>
                        <input type="month" id="start" name="start" min="2022-01"/>
                    </div>
                    <div class="item-button-z">
                        <a href="tambah-hari-libur.php">Tambah</a>
                    </div>
                </div>
                <div class="table-z" id="table"></div> <!-- tempat table -->
            </div>
            <div class="box-item">
                <div style="font-size: 16px; font-weight:500;">Atur Lokasi Toko</div>
                <div id='map' style='width: 100%; height: 60%; margin-top: 10px;'></div>
                <div class="item-button-c">
                    <button class="btn-lokasi">Atur Lokasi</button>
                </div>
            </div>
            <div class="box-item"></div>
        </div>
    </div>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <script>
        navigator.geolocation.getCurrentPosition(function(position) { /* get lokasi user */
            let lat = position.coords.latitude; 
            let long = position.coords.longitude; 

            console.log(lat);
            console.log(long);

            mapboxgl.accessToken = 'pk.eyJ1IjoiZGVhMTAiLCJhIjoiY2tzOWFwdnlxMHNyaTMxcGU5NnBnaWhtNCJ9.m9atsKQbdp-Vg5a5DMPlMw';
            var map = new mapboxgl.Map({
            container: 'map',
            center: [long, lat], 
            zoom: 15,
            style: 'mapbox://styles/mapbox/streets-v11'
            });

            const marker1 = new mapboxgl.Marker()
                .setLngLat([long, lat])
                .addTo(map);
            
            $('.btn-lokasi').on('click', function(e) {
                console.log("h");
                let pegawai = <?php echo $_SESSION['id_pegawai']; ?>;
                let url = 
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
                        pegawai: pegawai,
                        long: long,
                        lat: lat
                    },
                    //ni yg dibawah nie biar return datanya type datanya json biar bisa pake titik dibawah response.namavariablenya
                    dataType: 'json',
                    success: function(response) {
                        successRedirectMessage(response.message, dest)
                    },
                    error: function(response) {
                        errorMessage(response.message);
                    }
                });
            });
        })

        $(document).ready(function(){
            load_data();

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"tabel-hari-libur.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#table').html(data);
                    }
                });
            }
        });
    </script>
</body>

</html>