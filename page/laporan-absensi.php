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
        $d=strtotime("today");
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
                        <input type="month" id="month_year" name="month_year"/>
                    </div>
                    <div class="item-control-mp">
                        <label for="bulan">Jumlah kehadiran penuh : 
                            <?php 
                                $res6 = $db->query("SELECT COUNT(id_tgl) FROM `tanggal_libur` WHERE MONTH(tgl_awal_libur) = '$month';");
                                $res7 = $db->query("SELECT * FROM `tanggal_libur` WHERE MONTH(tgl_awal_libur) = '$month';");
                                if($res6){
                                    if($res6->num_rows>0){
                                        $data6=$res6->fetch_assoc();
                                        if ($res7) {
                                            $data7 = $res7->fetch_all(MYSQLI_ASSOC);
                                            $x = 0;
                                            foreach ($data7 as $barisdata) {
                                                $startTimeStamp = strtotime($barisdata['tgl_awal_libur']);
                                                $endTimeStamp = strtotime($barisdata['tgl_akhir_libur']);
                                                $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                                $numberDays = $timeDiff/86400;
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
                        // if (isset($_GET['filter_tanggal']) && $_GET['filter_tanggal'] != '') {
                        //     $bln = substr($_GET['filter_tanggal'], 5, 2);
                        //     $thn = substr($_GET['filter_tanggal'], 0, 4);
                        //     $sql = "SELECT log_absen.waktu_absen, pegawai.nama, report_event.status FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report JOIN pegawai ON pegawai.id_pegawai = log_absen.id_pegawai WHERE DAY(waktu_absen) = '$tgl' AND MONTH(waktu_absen) = '$bln' AND YEAR(waktu_absen) = '$thn';";
                        // } else {
                        //     $sql = "SELECT log_absen.waktu_absen, pegawai.nama, report_event.status FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report JOIN pegawai ON pegawai.id_pegawai = log_absen.id_pegawai WHERE DATE_FORMAT(log_absen.waktu_absen, '%Y-%m-%d') = '$tgl';";
                        // }
                    ?>
                        <tr>
                        <?php
                            $nama = "SELECT nama FROM pegawai WHERE status_aktif = 'Aktif' ORDER BY id_pegawai;";
                            $res_nama = $db->query($nama);
                            $data_nama = $res_nama->fetch_all(MYSQLI_ASSOC);
                            foreach ($data_nama as $datanama) {
                            
                    ?>
                                <td align="center"></td>
                                <td><?php echo $datanama['nama']; ?></td>
                    <?php
                            }
                            $hadir = "SELECT COUNT(report_event.id_report) FROM report_event JOIN log_absen ON report_event.id_report = log_absen.id_absen JOIN pegawai ON pegawai.id_pegawai = log_absen.id_pegawai WHERE MONTH(waktu_absen) = '$month' AND (`status` = 'Hadir' OR `status` = 'Terlambat') AND pegawai.status_aktif = 'Aktif' ORDER BY pegawai.id_pegawai;";
                            $res_hadir = $db->query($hadir);
                            $data_hadir = $res_hadir->fetch_all(MYSQLI_ASSOC);
                            foreach ($data_hadir as $datahadir) {
                    ?>
                                <td><?php echo $datahadir["COUNT(report_event.id_report)"]; ?></td>
                    <?php
                            } 
                            
                            
                            $langgar = "SELECT * FROM report_event JOIN log_absen ON report_event.id_report = log_absen.id_absen JOIN pegawai ON pegawai.id_pegawai = log_absen.id_pegawai WHERE MONTH(waktu_absen) = '01' AND `status` = 'Terlambat' ORDER BY pegawai.id_pegawai ORDER BY pegawai.id_pegawai;";
                    $izin = "SELECT * FROM report_event JOIN izin_cuti ON report_event.id_report = izin_cuti.id_report JOIN pegawai ON pegawai.id_pegawai = izin_cuti.id_pegawai WHERE MONTH(tanggal_awal_izin) = '01' and report_event.status = 'Izin' and izin_cuti.verifikasi = 'Diizinkan' ORDER BY pegawai.id_pegawai;";
                    $cuti = "SELECT * FROM report_event JOIN izin_cuti ON report_event.id_report = izin_cuti.id_report JOIN pegawai ON pegawai.id_pegawai = izin_cuti.id_pegawai WHERE MONTH(tanggal_awal_izin) = '01' and  OR report_event.status = 'Cuti' and izin_cuti.verifikasi = 'Diizinkan' ORDER BY pegawai.id_pegawai;";
                    $res = $db->query($sql);
                    if ($res) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                ?>

                                <td>
                                    <?php
                                        if ($barisdata["status"] == 'Terlambat') {
                                            if ($res_jam) {
                                                $data_jam = $res_jam->fetch_assoc();
                                                // $time = [$data_jam['jam_buka'], $data_jam['toleransi']];
                                                // $sum = strtotime('00:00:00');
                                                // $totaltime = 0;
                                                // foreach( $time as $element ) {
     
                                                //     // Converting the time into seconds
                                                //     $timeinsec = strtotime($element) - $sum;
                                                     
                                                //     // Sum the time with previous value
                                                //     $totaltime = $totaltime + $timeinsec;
                                                // }
                                                // $h = intval($totaltime / 3600);                                       
                                                // $totaltime = $totaltime - ($h * 3600);
                                                // $m = intval($totaltime / 60);
                                                // $s = $totaltime - ($m * 60);
                                                
                                                //Printing the result
                                                echo $barisdata['status'] . "";
                                            }
                                        } else {
                                            echo $barisdata["status"];
                                        }
                                    ?>
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