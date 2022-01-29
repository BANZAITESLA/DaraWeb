<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-pgw.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Laporan Absensi</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php
    menu_pgw();
    $db = dbConnect();
    $d = strtotime("today");
    $tgl = date("Y-m-d", $d);
    $day = date("l", $d);
    $sum = date("t", $d);
    $month = date("m", $d);
    if ($day == 'Monday') {
        $day = 'Senin';
    } else if ($day == 'Tuesday') {
        $day = 'Selasa';
    } else if ($day == 'Wednesday') {
        $day = 'Rabu';
    } else if ($day == 'Thursday') {
        $day = 'Kamis';
    } else if ($day == 'Friday') {
        $day = 'Jumat';
    } else if ($day == 'Saturday') {
        $day = 'Sabtu';
    } else {
        $day = 'Minggu';
    }
    ?>
    <div class="container-all">
        <div class="head-info">Laporan Absensi</div>
        <div class="container-form-c">
            <div class="head-box-item" style="margin: 20px;">
                <div class="item-control-mp">
                    <label for="bulan">Bulan</label>
                    <input type="month" id="month_year" name="month_year" />
                </div>
                <div class="item-control-mp">
                    <label for="bulan">Jumlah kehadiran penuh :
                        <?php
                        if (isset($_GET['filter_tanggal']) && $_GET['filter_tanggal'] != '') {
                            $bln = substr($_GET['filter_tanggal'], 5, 2);
                            $thn = substr($_GET['filter_tanggal'], 0, 4);
                        }
                        $res6 = $db->query("SELECT COUNT(id_tgl) FROM `tanggal_libur` WHERE MONTH(tgl_awal_libur) = '$bln';");
                        $res7 = $db->query("SELECT * FROM `tanggal_libur` WHERE MONTH(tgl_awal_libur) = '$bln';");
                        if ($res6) {
                            if ($res6->num_rows > 0) {
                                $data6 = $res6->fetch_assoc();
                                if ($res7) {
                                    $data7 = $res7->fetch_all(MYSQLI_ASSOC);
                                    $x = 0;
                                    foreach ($data7 as $barisdata) {
                                        $startTimeStamp = strtotime($barisdata['tgl_awal_libur']);
                                        $endTimeStamp = strtotime($barisdata['tgl_akhir_libur']);
                                        $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                        $numberDays = $timeDiff / 86400;
                                        $numberDays = intval($numberDays);
                                        $x = $x + $numberDays;
                                    }
                                    $total = $sum - $x;
                                    echo $total;
                                }
                            }
                        }
                        ?> hari</label>
                </div>
            </div>
            <div class="table" id="table">
            <table id="tabelJabatan" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No Urut</th>
                        <th>Nama Pegawai</th>
                        <th>Kehadiran</th>
                        <th>Pelanggaran</th>
                        <th>Izin</th>
                        <th>Cuti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($db->connect_errno == 0) { /* ketika koneksi db success */
                        $sql = "SELECT * FROM pegawai JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE pegawai.status_aktif = 'Aktif' AND jabatan.nama_jabatan != 'Pemilik Usaha';";
                        $res = $db->query($sql);
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $pegawai) {
                            $queryKehadiran = "SELECT * FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report WHERE log_absen.id_pegawai = '$pegawai[id_pegawai]' AND (report_event.status = 'Hadir' OR report_event.status = 'Terlambat') AND (MONTH(log_absen.waktu_absen) = '$bln' AND YEAR(log_absen.waktu_absen) = '$thn');";
                            $resKehadiran = $db->query($queryKehadiran) or die($db->error);
                            $dataKehadiran = $resKehadiran->fetch_all(MYSQLI_ASSOC);
                            $kehadiran = 0;
                            foreach ($dataKehadiran as $data) {
                                $kehadiran++;
                            }
                            $persentase_kehadiran = round(($kehadiran / $total) * 100, 2) . ' % (' . $kehadiran . ' dari ' . $total . ')';

                            $queryPelanggaran = "SELECT * FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report WHERE log_absen.id_pegawai = '$pegawai[id_pegawai]' AND (report_event.status = 'Tanpa Keterangan' OR report_event.status = 'Terlambat') AND (MONTH(log_absen.waktu_absen) = '$bln' AND YEAR(log_absen.waktu_absen) = '$thn');";
                            $resPelanggaran = $db->query($queryPelanggaran) or die($db->error);
                            $dataPelanggaran = $resPelanggaran->fetch_all(MYSQLI_ASSOC);
                            $pelanggaran = 0;
                            foreach ($dataPelanggaran as $data) {
                                $pelanggaran++;
                            }
                            $persentase_pelanggaran = round(($pelanggaran / $total) * 100, 2) . ' % (' . $pelanggaran . ' dari ' . $total . ')';

                            $queryIzin = "SELECT * FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report WHERE izin_cuti.id_pegawai = '$pegawai[id_pegawai]' AND report_event.status = 'Izin' AND MONTH(izin_cuti.tanggal_awal_izin) = '$bln' AND YEAR(izin_cuti.tanggal_awal_izin) = '$thn' AND izin_cuti.verifikasi = 'Diizinkan';";
                            $resIzin = $db->query($queryIzin) or die($db->error);
                            $dataIzin = $resIzin->fetch_all(MYSQLI_ASSOC);
                            $izin = 0;
                            foreach ($dataIzin as $data) {
                                $izin++;
                            }
                            $persentase_izin = round(($izin / $total) * 100, 2) . ' % (' . $izin . ' dari ' . $total . ')';

                            $queryCuti = "SELECT * FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report WHERE izin_cuti.id_pegawai = '$pegawai[id_pegawai]' AND report_event.status = 'Cuti' AND MONTH(izin_cuti.tanggal_awal_izin) = '$bln' AND YEAR(izin_cuti.tanggal_awal_izin) = '$thn' AND izin_cuti.verifikasi = 'Diizinkan';";
                            $resCuti = $db->query($queryCuti) or die($db->error);
                            $dataCuti = $resCuti->fetch_all(MYSQLI_ASSOC);
                            $cuti = 0;
                            foreach ($dataCuti as $data) {
                                $cuti++;
                            }
                            $persentase_cuti = round(($cuti / $total) * 100, 2) . ' % (' . $cuti . ' dari ' . $total . ')';
                    ?>
                            <tr>
                                <td align="center"></td>
                                <td><?php echo $pegawai['nama']; ?></td>
                                <td><?php echo $persentase_kehadiran; ?></td>
                                <td><?php echo $persentase_pelanggaran; ?></td>
                                <td><?php echo $persentase_izin; ?></td>
                                <td><?php echo $persentase_cuti; ?></td>
                                <td align="center">
                                <a href="detail-absensi-pegawai.php?id_pegawai=<?php echo $pegawai["id_pegawai"] . '&filter_tanggal=' . $_GET['filter_tanggal'] ;?>" ><button title="Detail"><i class="fas fa-info"></i></button></a>
                                </td>
                            </tr>
                    <?php
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
            }]
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

        let urlFilter = document.URL;
        let thn = new URL(document.URL);
        let filter = thn.searchParams.get("filter_tanggal");
        $('#month_year').val(filter ?? '');
        $('#month_year').on('change', function() {
            urlFilter = updateURLParameter(urlFilter, 'filter_tanggal', $(this).val());
            window.location.href = urlFilter;
        });
    </script>
</body>

</html>