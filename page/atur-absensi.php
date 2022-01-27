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
                        <input type="month" id="month_year" name="month_year"/>
                    </div>
                    <div class="item-button-z">
                        <a href="tambah-hari-libur.php">Tambah</a>
                    </div>
                </div>
                <div class="table-z" id="table"></div> <!-- tempat table -->
            </div>
            <div class="box-item">
                <div style="font-size: 16px; font-weight:500;">Atur Lokasi Toko</div>
                <div id='map' style='width: 100%; height: 90px; margin-top: 10px;'></div>
                <div class="item-button-c">
                    <button class="btn-lokasi">Atur Lokasi</button>
                </div>
            </div>
            <div class="box-item" style="display: flex; flex-direction: column; flex-wrap: nowrap; justify-content: flex-end; align-items: stretch; height: fit-content;">
                <div style="font-size: 16px; font-weight:500;">Atur Waktu Operasional Toko</div>
                <?php
                    $db=dbConnect();
                    if($db->connect_errno==0) {
                ?>
                                <form action="" method="post" id="formData" class="form-info" style="padding-top: 5px;">
                                    <div class="data-control-smol">
                                        <label for="hari">Senin</label>
                                        <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '1';"); $data=$res->fetch_assoc(); ?>
                                        <input type="time" id="senin_buka" value="<?php echo $data['jam_buka']; ?>" required />
                                        -
                                        <input type="time" id="senin_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                                    </div>
                                    <div class="data-control-smol">
                                        <label for="hari">Selasa</label>
                                        <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '2';"); $data=$res->fetch_assoc(); ?>
                                        <input type="time" id="selasa_buka" value="<?php echo $data['jam_buka']; ?>" required />
                                        -
                                        <input type="time" id="selasa_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                                    </div>
                                    <div class="data-control-smol">
                                        <label for="hari">Rabu</label>
                                        <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '3';"); $data=$res->fetch_assoc(); ?>
                                        <input type="time" id="rabu_buka" value="<?php echo $data['jam_buka']; ?>" required />
                                        -
                                        <input type="time" id="rabu_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                                    </div>
                                    <div class="data-control-smol">
                                        <label for="hari">Kamis</label>
                                        <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '5';"); $data=$res->fetch_assoc(); ?>
                                        <input type="time" id="kamis_buka" value="<?php echo $data['jam_buka']; ?>" required />
                                        -
                                        <input type="time" id="kamis_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                                    </div>
                                    <div class="data-control-smol">
                                        <label for="hari">Jumat</label>
                                        <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '6';"); $data=$res->fetch_assoc(); ?>
                                        <input type="time" id="jumat_buka" value="<?php echo $data['jam_buka']; ?>" required />
                                        -
                                        <input type="time" id="jumat_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                                    </div>                                    
                                    <div class="data-control-smol">
                                        <label for="hari">Sabtu</label>
                                        <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '7';"); $data=$res->fetch_assoc(); ?>
                                        <input type="time" id="sabtu_buka" value="<?php echo $data['jam_buka']; ?>" required />
                                        -
                                        <input type="time" id="sabtu_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                                    </div>                                    
                                    <div class="data-control-smol">
                                        <label for="hari">Minggu</label>
                                        <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '8';"); $data=$res->fetch_assoc(); ?>
                                        <input type="time" id="minggu_buka" value="<?php echo $data['jam_buka']; ?>" required />
                                        -
                                        <input type="time" id="minggu_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                                    </div>
                                    <div class="data-control-smol">
                                        <label for="hari" style="width: 50%;">Toleransi terlambat</label>
                                        <input type="time" min="00:00:00" max="00:59:00" id="toleransi" value="<?php echo $data['toleransi']; ?>" required />
                                        menit
                                       </div>
                                    <div class="submit" style="margin: 10px 0 0 0;justify-content: center;">
                                        <div class="save-smol">
                                            <input type="submit" name="Simpan" value="Simpan" />
                                        </div>
                                        <div class="cancel-smol">
                                            <input type="reset" name="Reset" value="Reset" />
                                        </div>
                                    </div>
                                </form>
                <?php
                    } else {
                        echo '<script type="text/javascript">', 'errorMessage("Tidak dapat terhubung ke Database. Hubungi Administrator.");', '</script>';
                    }
                ?>
            </div>
        </div>
    </div>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <script>
        // navigator.geolocation.getCurrentPosition(function(position) {
        //     /* get lokasi user */
        //     let lat = position.coords.latitude;
        //     let long = position.coords.longitude;

        //     console.log(lat);
        //     console.log(long);

        //     mapboxgl.accessToken = 'pk.eyJ1IjoiZGVhMTAiLCJhIjoiY2tzOWFwdnlxMHNyaTMxcGU5NnBnaWhtNCJ9.m9atsKQbdp-Vg5a5DMPlMw';
        //     var map = new mapboxgl.Map({
        //         container: 'map',
        //         center: [long, lat],
        //         zoom: 15,
        //         style: 'mapbox://styles/mapbox/streets-v11'
        //     });

        //     const marker1 = new mapboxgl.Marker()
        //         .setLngLat([long, lat])
        //         .addTo(map);

        //     $('.btn-lokasi').on('click', function(e) {
        //         console.log("h");
        //         let pegawai = <?php echo $_SESSION['id_pegawai']; ?>;
        //         let url = "konfir-atur-lokasi.php";
        //             $.ajax({
        //                 method: "POST",
        //                 url: url,
        //                 data: {
        //                     //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
        //                     pegawai: pegawai,
        //                     long: long,
        //                     lat: lat
        //                 },
        //                 //ni yg dibawah nie biar return datanya type datanya json biar bisa pake titik dibawah response.namavariablenya
        //                 dataType: 'json',
        //                 success: function(response) {
        //                     successMessage(response.message);
        //                 },
        //                 error: function(response) {
        //                     errorMessage(response.message);
        //                 }
        //             });
        //     });
        // })

        $(document).ready(function() {
            load_data();

            function load_data(query) {
                /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url: "tabel-hari-libur.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#table').html(data);
                    }
                });
            }

            $('#month_year').on('input', function() { /* jquery ketika terdapat input cari */
                console.log($(this).val());
                var pencarian = $(this).val();
                let thn = pencarian.substring(0, 4);
                let bln = pencarian.substring(5, 8);
                console.log(thn);
                console.log(bln);
                if(pencarian != '') {
                    $.ajax({
                        url: "tabel-hari-libur.php",
                        method: "POST",
                        data: {
                            thn: thn,
                            bln: bln
                        },
                        success: function(data) {
                            $('#table').html(data);
                        }
                    });
                } else {
                    load_data();
                }
            });
        });

        $('#formData').on('submit', function(e) {
            let url = document.location.origin + "/daraweb/page/konfir-edit-jam.php";
            let dest = "atur-absensi.php";
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
                    senin_buka : $('#senin_buka').val(),
                    senin_tutup : $('#senin_tutup').val(),
                    selasa_buka : $('#selasa_buka').val(),
                    selasa_tutup : $('#selasa_tutup').val(),
                    rabu_buka : $('#rabu_buka').val(),
                    rabu_tutup : $('#rabu_tutup').val(),
                    kamis_buka : $('#kamis_buka').val(),
                    kamis_tutup : $('#kamis_tutup').val(),
                    jumat_buka : $('#jumat_buka').val(),
                    jumat_tutup : $('#jumat_tutup').val(),
                    sabtu_buka : $('#sabtu_buka').val(),
                    sabtu_tutup : $('#sabtu_tutup').val(),
                    minggu_buka : $('#minggu_buka').val(),
                    minggu_tutup : $('#minggu_tutup').val(),
                    toleransi : $('#toleransi').val()
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
            //ini maksudna yg dibawah biar fungsi pas mencet simpan gk lngung pke fungsi bawaan ke action di formnya tp di batalin jadi di handle sm ajax
            e.preventDefault();
            return false;
        });
    </script>
</body>

</html>