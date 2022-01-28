<?php
session_start(); /* session login dimulai */
function menu_owner()
{
    if (!empty($_SESSION['nama'])) { ?>
        <div class="sidebar">
            <div class="logo">
                <div style="font-size: 32px; font-weight:700; color:#ffc13b">DaraWeb.</div>
                <div style="font-size: 16px; font-weight:400; color:whitesmoke">Selamat Datang, <?php echo explode(' ', trim($_SESSION["nama"]))[0]; ?>!</div>
            </div>
            <div class="menu">
                <a href="beranda-owner.php" accesskey="b"><i class="fas fa-home"></i>Beranda</a>
                <hr>
                <a href="data-diri-owner.php" accesskey="d"><i class="fas fa-address-card"></i>Data Diri</a>
                <hr>
                <a href="atur-jabatan.php" accesskey="j"><i class="fas fa-cog"></i>Pengaturan Jabatan</a>
                <a href="atur-status.php" accesskey="s"><i class="fas fa-cog"></i>Pengaturan Status</a>
                <a href="pegawai-aktif.php" accesskey="a"><i class="fas fa-user-check"></i>Data Pegawai Aktif</a>
                <a href="pegawai-non-aktif.php" accesskey="n"><i class="fas fa-user-times"></i>Data Pegawai Non-Aktif</a>
                <hr>
                <a href="atur-absensi.php" accesskey="n"><i class="fas fa-cog"></i>Pengaturan Absensi</a>
                <a href="ajuan-izin-cuti.php" accesskey="i"><i class="fas fa-suitcase"></i>Ajuan Izin dan Cuti</a>
                <a href="log-absensi.php" accesskey="l"><i class="fas fa-list"></i>Log Absensi</a>
                <a href="laporan-absensi.php" accesskey="p"><i class="fas fa-file-invoice"></i>Laporan Absensi</a>
                <hr>
                <a href="logout.php" accesskey="l" id="logout"><i class="fas fa-sign-out-alt"></i>Keluar</a>
            </div>
        </div>
<?php
    } else {
        echo '<script type="text/javascript">', 'redirectMessage("Tidak dapat mengakses Sistem. Silahkan Login terlebih dahulu.", "../index.php");', '</script>';
    }
} ?>