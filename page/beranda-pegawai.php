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
                $db=dbConnect();
                if($db->connect_errno==0) {
            ?>
                    <div class="beranda-box-1">
                        <button id="satu">
                            <div class="box1">
                            <?php 
                                $res = $db->query("SELECT id_pegawai FROM log_absen WHERE DATE_FORMAT(log_absen.waktu_absen, '%Y-%m-%d') = '$tgl' AND id_pegawai = '$_SESSION[id_pegawai]';");
                                if($res){
                                    if($res->num_rows>0){
                            ?>
                                        <div class="box-icon">
                                            <i class="fas fa-check-double"></i>
                                        </div>
                                        <div class="box-icon-go">
                                            <span style="font-size: 18px; font-weight:500; margin-left: 20px;">Anda sudah melakukan absensi</span>
                                            <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                                        </div>
                            <?php
                                    } else {
                                        echo '0';
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
                    <div class="box2"></div>
                    <div class="box2"></div>
                </div>
                <div class="wrapper-2">
                    <div class="box2"></div>
                    <div class="box2"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#satu").on('click', function() {
            window.location.href="log-absensi-pegawai.php";
        });
    </script>
</body>

</html>