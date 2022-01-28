<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Beranda Owner</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Data Diri</div>
        <div class="container-form">
            <?php
                $d=strtotime("today");
                $tgl = date("Y-m-d", $d);
                $day = date("l", $d);
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
                    <button id="satu">
                        <div class="box1">
                            <div class="box-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        <div class="box-icon-go">
                            <span style="font-size: 18px; font-weight:500; margin-left: 20px;">Saat ini Anda memiliki 
                                <?php 
                                    $res = $db->query("SELECT COUNT(id_pegawai) FROM pegawai WHERE status_aktif = 'Aktif';");
                                    if($res){
                                        if($res->num_rows>0){
                                            $data=$res->fetch_assoc();
                                            echo $data['COUNT(id_pegawai)'];
                                        } else {
                                            echo '0';
                                        }
                                    }
                                ?> pegawai Aktif
                            </span>
                            <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                        </div>
                        </div>
                    </button>
                    <button id="dua">
                        <div class="box1">
                            <div class="box-icon">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <div class="box-icon-go">
                                <span  style="font-size: 18px; font-weight:500; margin-left: 20px;">
                                    <?php 
                                        $res1 = $db->query("SELECT COUNT(id_pegawai) FROM log_absen WHERE DATE_FORMAT(log_absen.waktu_absen, '%Y-%m-%d') = '$tgl';");
                                        if($res1){
                                            if($res->num_rows>0){
                                                $data1=$res1->fetch_assoc();
                                                echo $data1['COUNT(id_pegawai)'];
                                            } else {
                                                echo '0';
                                            }
                                        }
                                    ?> dari 
                                    <?php echo $data['COUNT(id_pegawai)'];?> pegawai Anda telah hadir!
                                </span>
                                <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                            </div>
                        </div>
                    </button>
                    <button id="tiga">
                        <div class="box1">
                            <div class="box-icon">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="box-icon-go">
                                <span  style="font-size: 18px; font-weight:500; margin-left: 20px;">
                                    <?php 
                                        $res2 = $db->query("SELECT COUNT(id_pegawai) FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report WHERE DATE_FORMAT(log_absen.waktu_absen, '%Y-%m-%d') = '2022-01-28' AND report_event.status = 'Terlambat' ;");
                                        if($res2){
                                            if($res2->num_rows>0){
                                                $data2=$res2->fetch_assoc();
                                                echo $data2['COUNT(id_pegawai)'];
                                            } else {
                                                echo '0';
                                            }
                                        }
                                    ?> pegawai terlambat
                                </span>
                                <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                            </div>
                        </div>
                    </button>
                </div>
                <div class="beranda-box-2">
                    <div class="wrapper-1">
                        <button id="empat">
                            <div class="box2">
                            <span>Anda memiliki
                                <?php 
                                    $res3 = $db->query("SELECT COUNT(id_pegawai) FROM izin_cuti WHERE verifikasi = 'Belum Dikonfirmasi';");
                                    if($res3){
                                        if($res3->num_rows>0){
                                            $data3=$res3->fetch_assoc();
                                            echo $data3['COUNT(id_pegawai)'];
                                        } else {
                                            echo '0';
                                        }
                                    }
                                    ?> ajuan izin / cuti yang belum dikonfirmasi</span>
                                <div class="box-icon">
                                    <i class="fas fa-spinner" style="font-size: 36px;"></i>
                                    <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                                </div>
                            </div>
                        </button>
                        <button id="lima">
                            <div class="box2">
                            <span>Sebanyak
                                <?php 
                                    $res4 = $db->query("SELECT COUNT(id_pegawai) FROM izin_cuti WHERE (verifikasi = 'Diizinkan') AND ((tanggal_awal_izin BETWEEN '$tgl'AND '$tgl') OR (tanggal_akhir_izin BETWEEN '$tgl' AND '$tgl') OR (tanggal_awal_izin <= '$tgl' AND tanggal_akhir_izin >= '$tgl'));");
                                    if($res4){
                                        if($res4->num_rows>0){
                                            $data4=$res4->fetch_assoc();
                                            echo $data4['COUNT(id_pegawai)'];
                                        } else {
                                            echo '0';
                                        }
                                    }
                                    ?> pegawai Anda sedang mengambil izin / cuti</span>
                                <div class="box-icon">
                                    <i class="fas fa-plane" style="font-size: 36px;"></i>
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
                        <button id="enam">
                            <div class="box2">
                            <span>Bulan ini, kami mencatat jumlah hari kerja Toko Anda adalah sebanyak <??> hari! <br><br> dan libur sebanyak <??> hari..</span>
                                <div class="box-icon">
                                    <i class="fas fa-calendar" style="font-size: 36px;"></i>
                                    <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
    <script>
        $("#satu").on('click', function() {
            window.location.href="pegawai-aktif.php";
        });
        $("#dua").on('click', function() {
            window.location.href="log-absensi.php";
        });
        $("#tiga").on('click', function() {
            window.location.href="log-absensi.php";
        });
        $("#empat").on('click', function() {
            window.location.href="ajuan-izin-cuti.php";
        });
        $("#lima").on('click', function() {
            window.location.href="ajuan-izin-cuti.php";
        });
    </script>
</body>

</html>