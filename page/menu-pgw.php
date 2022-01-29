<?php
session_start(); /* session login dimulai */
function menu_pgw()
{
    if (!empty($_SESSION['nama'])) { ?>
        <div class="sidebar">
            <div class="logo">
                <div style="font-size: 32px; font-weight:700; color:#ffc13b">DaraWeb.</div>
                <div style="font-size: 16px; font-weight:400; color:whitesmoke">Selamat Datang, <?php echo explode(' ', trim($_SESSION["nama"]))[0]; ?>!</div>
            </div>
            <div class="menu">
                <a href="beranda-pegawai.php" accesskey="b"><i class="fas fa-home"></i>Beranda</a>
                <hr>
                <a href="data-diri-pegawai.php" accesskey="d"><i class="fas fa-address-card"></i>Data Diri</a>
                <hr>
                <a href="hari-libur.php" accesskey="b"><i class="far fa-calendar-minus"></i>Hari Libur</a>
                <a href="ajuan-pegawai.php" accesskey="b"><i class="fas fa-plane"></i>Pengajuan Izin & Cuti</a>
                <a href="log-absensi-pegawai.php" accesskey="b"><i class="fas fa-list"></i>Log Absensi</a>
                <a href="laporan-absensi-pegawai.php?filter_tanggal=<?php echo date('Y').'-'.date('m'); ?>" accesskey="p"><i class="fas fa-file-invoice"></i>Laporan Absensi</a>                
                <hr>
                <a href="logout.php" accesskey="l" id="logout"><i class="fas fa-sign-out-alt"></i>Keluar</a>
                </div>
        </div>
<?php
    } else {
        echo '<script type="text/javascript">', 'redirectMessage("Tidak dapat mengakses Sistem. Silahkan Login terlebih dahulu.", "../index.php");', '</script>';
    }
} ?>