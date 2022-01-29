<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Laporan Absensi</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php
    menu_owner();
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
                        $res6 = $db->query("SELECT COUNT(id_tgl) FROM `tanggal_libur` WHERE MONTH(tgl_awal_libur) = '$month';");
                        $res7 = $db->query("SELECT * FROM `tanggal_libur` WHERE MONTH(tgl_awal_libur) = '$month';");
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
                        $res6 = $db->query("SELECT COUNT(id_tgl) FROM `tanggal_libur` WHERE MONTH(tgl_awal_libur) = '$month';");
                        $res7 = $db->query("SELECT * FROM `tanggal_libur` WHERE MONTH(tgl_awal_libur) = '$month';");
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
                                }
                            }
                        }

                        $sql = "SELECT * FROM pegawai WHERE status_aktif = 'Aktif';";
                        $res = $db->query($sql);
                        $data = $res->fetch_all(MYSQLI_ASSOC);

                        $bln = '01';
                        $thn = '2022';
                        foreach ($data as $pegawai) {
                            $kehadiran = "SELECT COUNT(id_pegawai) FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report WHERE log_absen.id_pegawai = '$pegawai[id_pegawai]' AND (report_event.status = 'Hadir' OR report_event.status = 'Terlambat' AND MONTH(log_absen.waktu_absen) = '$bln' AND YEAR(log_absen.waktu_absen) = '$thn';";
                            $hdr = $db->query($kehadiran)->fetch_assoc();
                            $persentase_kehadiran =((int)$hdr['COUNT(id_pegawai)'] / $total) * 100;
                        
                            $pelanggaran = "SELECT COUNT(id_pegawai) FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report WHERE log_absen.id_pegawai = '$pegawai[id_pegawai]' AND (report_event.status = 'Tanpa Keterangan' OR report_event.status = 'Terlambat' AND MONTH(log_absen.waktu_absen) = '$bln' AND YEAR(log_absen.waktu_absen) = '$thn';";
                            $plg = $db->query($pelanggaran)->fetch_assoc();
                            $persentase_pelanggaran =((int)$plg['COUNT(id_pegawai)'] / $total) * 100;
                        
                            $izin = "SELECT COUNT(id_pegawai) FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report WHERE izin_cuti.id_pegawai = '$pegawai[id_pegawai]' AND report_event.status = 'Izin' AND MONTH(izin_cuti.tanggal_awal_izin) = '$bln' AND YEAR(izin_cuti.tanggal_awal_izin) = '$thn' AND izin_cuti.verifikasi = 'Diizinkan';";
                            $iz = $db->query($izin)->fetch_assoc();
                            $persentase_izin =((int)$iz['COUNT(id_pegawai)'] / $total) * 100;
                        
                            $cuti = "SELECT COUNT(id_pegawai) FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report WHERE izin_cuti.id_pegawai = '$pegawai[id_pegawai]' AND report_event.status = 'Cuti' AND MONTH(izin_cuti.tanggal_awal_izin) = '$bln' AND YEAR(izin_cuti.tanggal_awal_izin) = '$thn' AND izin_cuti.verifikasi = 'Diizinkan';";
                            $ct = $db->query($cuti)->fetch_assoc();
                            $persentase_cuti =((int)$ct['COUNT(id_pegawai)'] / $total) * 100;
                        ?>
                            <tr>
                                <td></td>
                                <td><?php echo $pegawai['nama']; ?></td>
                                <td><?php echo $persentase_kehadiran; ?></td>
                                <td><?php echo $persentase_pelanggaran; ?></td>
                                <td><?php echo $persentase_izin; ?></td>
                                <td><?php echo $persentase_cuti; ?></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                    } else {
                    }
                    ?>
            </table>
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