<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <?php include_once('../component/header.php') ?>
        <title>Absen DaraWeb</title>
        <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <div class="header">DaraWeb.</div>
    <div class="box-login">
        <div class="title-login">
            <?php
                $db = dbConnect();
                date_default_timezone_set('Asia/Jakarta'); // CDT
                $current_date = date('Y-m-d');

                $sql = "SELECT * from tanggal_libur where (tgl_awal_libur BETWEEN '$current_date'AND '$current_date') OR (tgl_akhir_libur BETWEEN '$current_date' AND '$current_date') OR (tgl_awal_libur <= '$current_date' AND tgl_akhir_libur >= '$current_date');";
                $res = $db->query($sql);
                if ($res) {
                    if ($res->num_rows == 0) { 
                        $lokasi = "SELECT * FROM lokasi;";
                        $res_lok = $db->query($lokasi);
                        if ($res_lok) {
                            if ($res_lok->num_rows == 1) {
                                $lok = $res_lok->fetch_assoc();
                                if ($lok['longitude'] == '106.8302336' && $lok['latitude'] == '-6.22592') {
                                    echo "Silahkan Scan QR Code untuk melakukan Absen <br><br>";
                                    echo '<img src="https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld&amp;size=200x200" alt="" title="Scan QR Code!" />';
                                } else {
                                    echo '<script type="text/javascript">', 'errorRedirectMessage("Pastikan lokasi Anda berada di Toko. Silahkan coba kembali.", "beranda-pegawai.php");', '</script>';
                                }
                            } 
                        }
                    } else {
                        echo '<script type="text/javascript">', 'errorRedirectMessage("Hari ini libur. Silahkan absen di hari kerja.", "beranda-pegawai.php");', '</script>';
                    }
                }
            ?>
        </div>
    </div>
    <script>
        navigator.geolocation.getCurrentPosition(function(position) {
            /* get lokasi user */
            let lat = position.coords.latitude;
            let long = position.coords.longitude;

            <?php 
                
            ?>
        });
    </script>
</body>

</html>