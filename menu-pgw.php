<?php
    session_start(); /* session login dimulai */
    include_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/style.css?v=1.0" rel="stylesheet">
</head>
<body>
    <?php
        function menu_pgw() {
            if(!empty($_SESSION['nama'])) {
    ?>
                <div class="sidebar">
                <div class="logo">
                    <div style="font-size: 32px; font-weight:700; color:#ffc13b">DaraWeb.</div>
                    <div style="font-size: 16px; font-weight:400; color:whitesmoke">Selamat Datang, <?php echo explode(' ',trim($_SESSION["nama"]))[0];?>!</div>
                </div>
                <div class="menu">
                    <a href="beranda-pgw.php" accesskey="b"><i class="fas fa-home"></i>Beranda</a>
                    <hr>
                    <a href="data-diri-pgw.php" accesskey="d"><i class="fas fa-address-card"></i>Data Diri</a>
                    <hr>
                    <a href="hari-libur.php" accesskey="b"><i class="far fa-calendar-minus"></i>Hari Libur</a>
                    <a href="#" accesskey="b"><i class="fas fa-plane"></i>Pengajuan Izin & Cuti</a>
                    <a href="#" accesskey="b"><i class="fas fa-list"></i>Log Absensi</a>
                    <a href="#" accesskey="b"><i class="fas fa-file-invoice"></i>Laporan Absensi</a>
                    <hr>
                    <a href="#" accesskey="l" id="logout"><i class="fas fa-sign-out-alt"></i>Keluar</a>
                </div>
            </div>
    <?php
            } else {
                echo '<script type="text/javascript">','logindulu();','</script>';
            }
        }
    ?>
    <script>
        $(document).on('click','#logout', function() {
            Swal.fire({
            icon : 'question',
            title : 'Konfirmasi',
            text : 'Apakah Anda yakin ingin keluar dari Sistem?',
            confirmButtonText: 'Ya',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            iconColor : '#1e3d59',
            width : '35%',
            color : '#000000',
            confirmButtonColor : '#09791c',
            cancelButtonColor : '#b31200',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "logout.php";
                }
            })
        })
    </script>
</body>
</html>