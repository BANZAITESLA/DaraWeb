<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-pgw.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Beranda Pegawai</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_pgw(); ?>
    <div class="container-all">
        <div class="head-info">Data Diri</div>
        <div class="container-form">
            <?php
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
                $db=dbConnect();
                if($db->connect_errno==0) {
            ?>
                    <div class="beranda-box-1">
                            <?php 
                                $res = $db->query("SELECT id_pegawai FROM log_absen WHERE DATE_FORMAT(log_absen.waktu_absen, '%Y-%m-%d') = '$tgl' AND id_pegawai = '$_SESSION[id_pegawai]';");
                                if($res){
                                    if($res->num_rows>0){
                            ?>
                                        <button id="satu">
                                            <div class="box1">
                                                <div class="box-icon">
                                                    <i class="fas fa-check-double"></i>
                                                </div>
                                                <div class="box-icon-go">
                                                    <span style="font-size: 18px; font-weight:500; margin-left: 20px;">Anda sudah melakukan absensi</span>
                                                    <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                                                </div>
                            <?php
                                    } else {
                            ?>
                                        <button id="dua">
                                            <div class="box1">
                                                <div class="box-icon">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </div>
                                                <div class="box-icon-go">
                                                    <span style="font-size: 18px; font-weight:500; margin-left: 20px;">Anda belum melakukan absensi</span>
                                                    <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                                                </div>
                            <?php
                                    }
                                }
                            ?> 
                                            </div>
                                        </button>
                    </div>
            <?php
                }
            ?>
                    <div class="beranda-box-2">
                        <div class="wrapper-1">
                            <button id="empat">
                                <div class="box2">
                                <span>Lindungi Data Diri Anda, <br> Jangan berikan password pada siapapun! <br><br> Gantilah password secara berkala</span>
                                    <div class="box-icon">
                                        <i class="fas fa-user-secret" style="font-size: 36px;"></i>
                                        <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </button>
                            <button id="lima">
                                <div class="box2">
                                <span>Anda memiliki total
                                    <?php 
                                        $res4 = $db->query("SELECT COUNT(id_pegawai) FROM `izin_cuti` WHERE id_pegawai = '$_SESSION[id_pegawai]' AND MONTH(tanggal_awal_izin) = '$month';");
                                        if($res4){
                                            if($res4->num_rows>0){
                                                $data4=$res4->fetch_assoc();
                                                echo $data4['COUNT(id_pegawai)'];
                                            } else {
                                                echo '0';
                                            }
                                        }
                                    ?> pengajuan izin/cuti, <br>
                                    <?php 
                                        $res41 = $db->query("SELECT COUNT(id_pegawai) FROM `izin_cuti` WHERE id_pegawai = '$_SESSION[id_pegawai]' AND MONTH(tanggal_awal_izin) = '$month' AND verifikasi = 'Diizinkan';");
                                        if($res41){
                                            if($res41->num_rows>0){
                                                $data41=$res41->fetch_assoc();
                                                echo $data41['COUNT(id_pegawai)'];
                                            } else {
                                                echo '0';
                                            }
                                        }
                                    ?> pengajuan telah diizinkan, <br>
                                    <?php 
                                        $res42 = $db->query("SELECT COUNT(id_pegawai) FROM `izin_cuti` WHERE id_pegawai = '$_SESSION[id_pegawai]' AND MONTH(tanggal_awal_izin) = '$month' AND verifikasi = 'Tidak Diizinkan';");
                                        if($res42){
                                            if($res42->num_rows>0){
                                                $data42=$res42->fetch_assoc();
                                                echo $data42['COUNT(id_pegawai)'];
                                            } else {
                                                echo '0';
                                            }
                                        }
                                    ?> pengajuan ditolak, <br>
                                    <?php 
                                        $res43 = $db->query("SELECT COUNT(id_pegawai) FROM `izin_cuti` WHERE id_pegawai = '$_SESSION[id_pegawai]' AND MONTH(tanggal_awal_izin) = '$month' AND verifikasi = 'Belum Dikonfirmasi';");
                                        if($res43){
                                            if($res43->num_rows>0){
                                                $data43=$res43->fetch_assoc();
                                                echo $data43['COUNT(id_pegawai)'];
                                            } else {
                                                echo '0';
                                            }
                                        }
                                    ?> pengajuan belum dikonfirmasi</span>
                                    <div class="box-icon">
                                        <i class="fas fa-info" style="font-size: 36px;"></i>
                                        <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="wrapper-2">
                            <button>
                                <div class="box2">
                                <span>Jam Operasional Toko Hari Ini, <br> Buka &emsp;: 
                                    <?php 
                                        $res5 = $db->query("SELECT * FROM `jam_operasional` WHERE hari = '$day';");
                                        if($res5){
                                            if($res5->num_rows>0){
                                                $data5=$res5->fetch_assoc();
                                                echo $data5['jam_buka'];
                                            }
                                        }
                                        ?> <br> Tutup&emsp;: <?php echo $data5['jam_tutup'];?></span>
                                    <div class="box-icon">
                                        <i class="fas fa-clock" style="font-size: 36px;"></i>
                                    </div>
                                </div>
                            </button>
                            <button id="enam" style="cursor: pointer;">
                                <div class="box2">
                                <span>Bulan ini, kami mencatat jumlah hari kerja Toko Anda adalah sebanyak
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
                                        ?> hari! <br><br> dan libur sebanyak <?php echo $x;?> hari..</span>
                                    <div class="box-icon">
                                        <i class="fas fa-calendar" style="font-size: 36px;"></i>
                                        <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
        </div>
    </div>
    <script>
        $("#satu").on('click', function() {
            window.location.href="log-absensi-pegawai.php";
        });
        $("#dua").on('click', function() {
            window.location.href="absen-pegawai.php";
        });
        $("#empat").on('click', function() {
            window.location.href="data-diri-pegawai.php";
        });
        $("#lima").on('click', function() {
            window.location.href="ajuan-pegawai.php";
        });
        $("#enam").on('click', function() {
            window.location.href="hari-libur.php";
        });
    </script>
</body>

</html>