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
    <?php
    menu_owner();
    $db = dbConnect();
    ?>
    <div class="container-all">
        <div class="head-info">Pengaturan Absensi</div>
        <div class="container-absen">
            <div class="box-item">
                <div style="font-size: 16px; font-weight:500;">Atur Hari Libur</div>
                <div class="head-box-item">
                    <div class="item-control-mp">
                        <label for="bulan"> Bulan</label>
                        <input type="month" id="month_year" name="month_year" />
                    </div>
                    <div class="item-button-z">
                        <a href="tambah-hari-libur.php">Tambah</a>
                    </div>
                </div>
                <div class="table-z" id="table">
                    <!-- table -->
                    <table id="tabelLibur" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No Urut</th>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($db->connect_errno == 0) { /* ketika koneksi db success */
                                if (isset($_GET['filter_tanggal']) && $_GET['filter_tanggal'] != '') {
                                    $bln = substr($_GET['filter_tanggal'], 5, 2);
                                    $thn = substr($_GET['filter_tanggal'], 0, 4);
                                    $sql = "SELECT * from tanggal_libur where MONTH(tgl_awal_libur) = '$bln' AND YEAR(tgl_awal_libur) = '$thn';";
                                } else {
                                    $sql = "SELECT * FROM tanggal_libur";
                                }
                                $res = $db->query($sql);
                                if ($res) {
                                    $data = $res->fetch_all(MYSQLI_ASSOC);
                                    $i = 1;
                                    foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                            ?>
                                        <tr>
                                            <td align="center"></td>
                                            <td><?php echo $barisdata["tgl_awal_libur"]; ?></td>
                                            <td><?php echo $barisdata["tgl_akhir_libur"]; ?></td>
                                            <td><?php echo $barisdata["ket"]; ?></td>
                                            <td align="center">
                                                <a href="edit-hari-libur.php?id_tgl=<?php echo $barisdata["id_tgl"]; ?>"><button title="Edit"><i class="fas fa-user-edit"></i></button></a>
                                                <button class="tombolHapus" value="<?php echo $barisdata["id_tgl"]; ?>" title="Hapus" style="background-color: #b31200;" onmouseover="this.style.backgroundColor='#920f00'" onMouseOut="this.style.backgroundColor='#b31200'"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            } else {
                            }
                            ?>
                    </table>
                </div>
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
                if ($db->connect_errno == 0) {
                ?>
                    <form action="" method="post" id="formData" class="form-info" style="padding-top: 5px;">
                        <div class="data-control-smol">
                            <label for="hari">Senin</label>
                            <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '1';");
                            $data = $res->fetch_assoc(); ?>
                            <input type="time" id="senin_buka" value="<?php echo $data['jam_buka']; ?>" required />
                            -
                            <input type="time" id="senin_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                        </div>
                        <div class="data-control-smol">
                            <label for="hari">Selasa</label>
                            <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '2';");
                            $data = $res->fetch_assoc(); ?>
                            <input type="time" id="selasa_buka" value="<?php echo $data['jam_buka']; ?>" required />
                            -
                            <input type="time" id="selasa_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                        </div>
                        <div class="data-control-smol">
                            <label for="hari">Rabu</label>
                            <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '3';");
                            $data = $res->fetch_assoc(); ?>
                            <input type="time" id="rabu_buka" value="<?php echo $data['jam_buka']; ?>" required />
                            -
                            <input type="time" id="rabu_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                        </div>
                        <div class="data-control-smol">
                            <label for="hari">Kamis</label>
                            <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '5';");
                            $data = $res->fetch_assoc(); ?>
                            <input type="time" id="kamis_buka" value="<?php echo $data['jam_buka']; ?>" required />
                            -
                            <input type="time" id="kamis_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                        </div>
                        <div class="data-control-smol">
                            <label for="hari">Jumat</label>
                            <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '6';");
                            $data = $res->fetch_assoc(); ?>
                            <input type="time" id="jumat_buka" value="<?php echo $data['jam_buka']; ?>" required />
                            -
                            <input type="time" id="jumat_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                        </div>
                        <div class="data-control-smol">
                            <label for="hari">Sabtu</label>
                            <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '7';");
                            $data = $res->fetch_assoc(); ?>
                            <input type="time" id="sabtu_buka" value="<?php echo $data['jam_buka']; ?>" required />
                            -
                            <input type="time" id="sabtu_tutup" value="<?php echo $data['jam_tutup']; ?>" required />
                        </div>
                        <div class="data-control-smol">
                            <label for="hari">Minggu</label>
                            <?php $res = $db->query("SELECT * FROM jam_operasional WHERE id_hari = '8';");
                            $data = $res->fetch_assoc(); ?>
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
        navigator.geolocation.getCurrentPosition(function(position) {
            /* get lokasi user */
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
                let url = "konfir-atur-lokasi.php";
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
                        successMessage(response.message);
                    },
                    error: function(response) {
                        errorMessage(response.message);
                    }
                });
            });
        })

        $(document).ready(function() {
            //nie inisialisasi datata
            var tabelLibur = $('#tabelLibur').DataTable({
                order: [
                    [1, 'asc']
                ],
                "language": {
                    "url": document.location.origin + "/daraweb/assets/id.json",
                },
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    },
                    {
                        "targets": 4,
                        "orderable": false
                    }
                ]
            });

            //nie buat no urut otomatis
            tabelLibur.on('order.dt search.dt', function() {
                tabelLibur.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            //nie event hapus
            $(".tombolHapus").on('click', function() {
                var value = $(this).attr('value');
                Swal.fire({
                    /* validasi hapus data */
                    icon: 'question',
                    title: 'Konfirmasi',
                    text: "Apakah Anda yakin ingin menghapus data ini?",
                    confirmButtonText: 'Ya',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    iconColor: '#1e3d59',
                    width: '35%',
                    color: '#000000',
                    confirmButtonColor: '#09791c',
                    cancelButtonColor: '#b31200',
                }).then((result) => {
                    if (result.isConfirmed) {
                        /* jika user mengklik 'Hapus' */
                        $(function() {
                            var urlHapusLibur = document.location.origin + "/daraweb/page/hapus-libur.php?id_tgl=" + value;
                            $.ajax({
                                /* ajax hapus sesuai id menu */
                                type: 'POST',
                                url: urlHapusLibur,
                                success: function(response) {
                                    successMessage("Data berhasil dihapus");

                                    //nie buat refresh tabel
                                    window.location.href = document.URL;
                                },
                                error: function(response) {
                                    errorMessage(response.message);
                                }
                            })
                        })
                    }
                })
            });
            let urlFilter = document.URL;
            let thn = new URL(document.URL);
            let filter = thn.searchParams.get("filter_tanggal");
            $('#month_year').val(filter ?? '');
            $('#month_year').on('change', function() {
                urlFilter = updateURLParameter(urlFilter, 'filter_tanggal', $(this).val());
                window.location.href = urlFilter;
            });

            $('#formData').on('submit', function(e) {
                let url = document.location.origin + "/daraweb/page/konfir-edit-jam.php";
                let dest = "atur-absensi.php";
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
                        senin_buka: $('#senin_buka').val(),
                        senin_tutup: $('#senin_tutup').val(),
                        selasa_buka: $('#selasa_buka').val(),
                        selasa_tutup: $('#selasa_tutup').val(),
                        rabu_buka: $('#rabu_buka').val(),
                        rabu_tutup: $('#rabu_tutup').val(),
                        kamis_buka: $('#kamis_buka').val(),
                        kamis_tutup: $('#kamis_tutup').val(),
                        jumat_buka: $('#jumat_buka').val(),
                        jumat_tutup: $('#jumat_tutup').val(),
                        sabtu_buka: $('#sabtu_buka').val(),
                        sabtu_tutup: $('#sabtu_tutup').val(),
                        minggu_buka: $('#minggu_buka').val(),
                        minggu_tutup: $('#minggu_tutup').val(),
                        toleransi: $('#toleransi').val()
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
        });
    </script>
</body>

</html>