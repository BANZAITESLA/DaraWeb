<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Ajuan Izin dan Cuti</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php
    menu_owner();
    $db = dbConnect();
    ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Ajuan Izin dan Cuti</div>
        <div class="container-form-c">
            <div class="head-box-item" style="margin: 20px;">
                <div class="item-control-mp">
                    <label for="bulan">Bulan</label>
                    <input type="month" id="month_year" name="month_year" />
                </div>
                <div class="item-control-mp">
                    <label for="ajuan">Ajuan</label>
                    <select name="ajuan" id="ajuan" style="padding: 2px 0;">
                        <option value="">Pilih Ajuan</option>
                        <option value="Izin">Izin</option>
                        <option value="Cuti">Cuti</option>
                    </select>
                </div>
                <div class="item-control-mp">
                    <label for="verif">Verifikasi</label>
                    <select name="verif" id="verif" style="padding: 2px 0;">
                        <option value="">Pilih Verifikasi</option>
                        <option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
                        <option value="Diizinkan">Diizinkan</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="item-button-z">
                    <a href="tambah-ajuan.php">Tambah</a>
                </div>
            </div>
            <div class="table" id="table">
                <!-- table -->
                <table id="tabelJabatan" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No Urut</th>
                            <th>Nama Pegawai</th>
                            <th>Ajuan</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Keterangan</th>
                            <th>Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($db->connect_errno == 0) { /* ketika koneksi db success */
                            $where = '';
                            $ajuan = '';
                            $verif = '';
                            if (isset($_GET['filter_tanggal']) && $_GET['filter_tanggal'] != '') { /* ketika ada input cari */
                                $bln = substr($_GET['filter_tanggal'], 5, 2);
                                $thn = substr($_GET['filter_tanggal'], 0, 4);
                                $where .= "AND MONTH(izin_cuti.tanggal_awal_izin) = '$bln' AND YEAR(izin_cuti.tanggal_awal_izin) = '$thn' ";
                            }

                            if (isset($_GET['filter_ajuan']) && $_GET['filter_ajuan'] != '') { /* ketika tidak ada input cari */
                                $where .= "AND report_event.status = '$_GET[filter_ajuan]' ";
                            }

                            if (isset($_GET['filter_verif']) && $_GET['filter_verif'] != '') {
                                $where .= "AND izin_cuti.verifikasi = '$_GET[filter_verif]'";
                            }

                            $sql = "SELECT * FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report JOIN pegawai ON izin_cuti.id_pegawai = pegawai.id_pegawai WHERE izin_cuti.id_perizinan is not null $where ;";
                            $res = $db->query($sql);
                            if ($res) {
                                $data = $res->fetch_all(MYSQLI_ASSOC);
                                foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                        ?>
                                    <tr>
                                        <td align="center"></td>
                                        <td><?php echo $barisdata["nama"]; ?></td>
                                        <td><?php echo $barisdata["status"]; ?></td>
                                        <td><?php echo $barisdata["tanggal_awal_izin"]; ?></td>
                                        <td><?php echo $barisdata["tanggal_akhir_izin"]; ?></td>
                                        <td><?php echo $barisdata["keterangan"]; ?></td>
                                        <td align="center">
                                            <?php if ($barisdata["verifikasi"] == "Belum Dikonfirmasi") { ?> <i class="fas fa-spinner" style="color: #6A6363"></i>
                                            <?php } else if ($barisdata["verifikasi"] == "Diizinkan") { ?> <i class="fas fa-check" style="color: #09791c"></i>
                                            <?php } else { ?> <i class="fas fa-times" style="color: #b31200"></i> <?php }; ?>
                                        </td>
                                        <td align="center">
                                            <a href="edit-verif.php?id_perizinan=<?php echo $barisdata["id_perizinan"]; ?>"><button title="Edit"><i class="fas fa-user-edit"></i></button></a>
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
    </div>
    <script>
        var tabelJabatan = $('#tabelJabatan').DataTable({
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
                    "targets": 7,
                    "orderable": false
                }
            ]
        });

        //nie buat no urut otomatis
        tabelJabatan.on('order.dt search.dt', function() {
            tabelJabatan.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        let thn = new URL(document.URL);
        let filter = thn.searchParams.get("filter_tanggal");
        $('#month_year').val(filter ?? '');

        let ajuan = new URL(document.URL);
        let filterAjuan = ajuan.searchParams.get("filter_ajuan");

        let verif = new URL(document.URL);
        let filterVerif = verif.searchParams.get("filter_verif");

        $("#ajuan option").each(function() {
            if ($(this).val() == filterAjuan) {
                $(this).attr("selected", "selected");
            }
        });

        $("#verif option").each(function() {
            if ($(this).val() == filterVerif) {
                $(this).attr("selected", "selected");
            }
        });

        let urlFilter = document.URL;
        $('#month_year').on('change', function() {
            urlFilter = updateURLParameter(urlFilter, 'filter_tanggal', $(this).val());
            window.location.href = urlFilter;
        });
        $('#ajuan').on('change', function() {
            urlFilter = updateURLParameter(urlFilter, 'filter_ajuan', $(this).val());
            window.location.href = urlFilter;
        });
        $('#verif').on('change', function() {
            urlFilter = updateURLParameter(urlFilter, 'filter_verif', $(this).val());
            window.location.href = urlFilter;
        });
    </script>
</body>

</html>