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
    <script>
        $('div.box-login').css('display','none');
        let checkLocationBlock = false;

        //check block posisi
        navigator.geolocation.watchPosition(function(position) {
                checkLocationBlock = true;
            },
            function(error) {
                if (error.code == error.PERMISSION_DENIED) {
                    checkLocationBlock = false;
                    errorRedirectMessage('Izin Lokasi diblock, Silahkan buka akses perizinan lokasi pada website ini', document.URL);
                }
            });

        let theUrl = new URL(document.URL);
        let findLongitude = theUrl.searchParams.get("longitude");
        let findLatitude = theUrl.searchParams.get("latitude");

        //cek jika parameter longitude dan latitude tidak ada
        function updateLongLat(uri, lat, long) {
            let firstUrl = updateURLParameter(uri, 'longitude', long);
            let finalurl = updateURLParameter(firstUrl, 'latitude', lat);
            window.location.href = finalurl;
        };

        function checkJikaParameterTidakAda(urifor) {
            navigator.geolocation.getCurrentPosition(function(position) {
                /* get lokasi user */
                let lat = position.coords.latitude;
                let long = position.coords.longitude;
                updateLongLat(urifor, lat, long);
            });
        }

        //cek jika lokasi tidak sesuai
        function updateLongLatWithAlert(urlnyaw) {
            errorRedirectMessage('Lokasi Tidak Sesuai', urlnyaw);
        };

        function checkJikaParameterTidakSesuai(urlnya) {
            navigator.geolocation.getCurrentPosition(function(position) {
                /* get lokasi user */
                let newLat = position.coords.latitude;
                let newLong = position.coords.longitude;

                // console.log(findLongitude + ' == ' + newLong);
                // console.log(findLatitude + ' == ' + newLat);
                if (findLongitude != newLong && findLatitude != newLat) {
                    firstUrl = updateURLParameter(urlnya, 'longitude', newLong);
                    finalurl = updateURLParameter(firstUrl, 'latitude', newLat);
                    updateLongLatWithAlert(finalurl);
                    console.log('beda');
                } else {
                    console.log('sama');
                }
            });
        }


        if (findLongitude == null && findLatitude == null) {
            checkJikaParameterTidakAda(document.URL);
        } else {
            console.log('passed 1');
            $('div.box-login').css('display','block');
        }

        if (findLongitude != null && findLatitude != null) {
            checkJikaParameterTidakSesuai(document.URL);
        } else {
            console.log('passed 2');
            $('div.box-login').css('display','block');
        }
    </script>
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
                            if ($lok['longitude'] == $_GET['longitude'] && $lok['latitude'] == $_GET['latitude']) {
                                echo "Silahkan Scan QR Code untuk melakukan Absen <br><br>";
                                echo '<img src="https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld&amp;size=200x200" alt="" title="Scan QR Code!" />';
                            } else {
                                echo '<script type="text/javascript">', 'errorRedirectMessage("Pastikan lokasi Anda berada di Toko. Tunggu Beberapa Saat atau Klik Tombol OK.", document.location.origin + "/daraweb/page/absen-pegawai.php");', '</script>';
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
</body>

</html>