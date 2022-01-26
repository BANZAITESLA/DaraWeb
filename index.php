<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <?php include_once('component/headerLogin.php'); ?>
        <title>Login DaraWeb</title>
        <?php include_once('component/script.php'); ?>
</head>

<body>
    <?php include_once('component/functions.php'); ?>
    <?php
        $db = dbConnect();
        if (isset($_POST["Masuk"])) {
            if ($db->connect_errno == 0) {
                $username = $db->escape_string($_POST["username"]);
                $password = $db->escape_string($_POST["password"]);

                $cek_user = "SELECT id_pegawai FROM `pegawai` WHERE id_pegawai = '$username'";
                $res1 = $db->query($cek_user);

                if ($res1) {
                    if ($res1->num_rows == 1) {
                        $cek_pass = "SELECT id_pegawai, nama FROM `pegawai` WHERE id_pegawai = '$username' and `password` = md5('$password')";
                        $res2 = $db->query($cek_pass);
                        if ($res2) {
                            if ($res2->num_rows == 1) {
                                $data = $res2->fetch_assoc();
                                $_SESSION['id_pegawai'] = $data['id_pegawai'];
                                $_SESSION['nama'] = $data['nama'];

                                if ($username = '12345678') {  // !XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                                    $url = "/daraweb/page/beranda-owner.php";
                                } else {
                                    $url = "/daraweb/page/beranda-pegawai.php";
                                }
                                redirect($url);
                            } else {
                                echo '<script type="text/javascript">', 'errorMessage("Password salah / tidak sesuai");', '</script>';
                            }
                        }
                    } else {
                        echo '<script type="text/javascript">', 'errorMessage("ID Pegawai salah / tidak terdaftar");', '</script>';
                    }
                }
            } else {
                echo '<script type="text/javascript">', 'errorMessage("Tidak dapat terhubung ke Database. Hubungi Administrator.");', '</script>';
            }
        }
    ?>
    <div class="header">DaraWeb.</div>
    <div class="box-login">
        <div class="title-login">
            Sistem Informasi Absensi Toko Dara Frozen Food
        </div>
        <form id="formLogin" class="form" method="post" action="index.php">
            <!-- form login -->
            <div class="form-control">
                <label for="username">ID Pegawai</label>
                <input type="text" placeholder="Masukkan ID Pegawai" id="username" name="username" />
                <i class="fas fa-exclamation-circle"></i>
                <small></small> <!-- err msg  -->
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" placeholder="Masukkan Password" id="password" name="password" />
                <i class="fas fa-exclamation-circle"></i>
                <small></small> <!-- err msg  -->
            </div>
            <a href="./page/lupa-password.php">Lupa Password?</a>
            <div class="form-submit">
                <input type="submit" name="Masuk" value="Masuk" />
            </div>
        </form>
    </div>

    <script src="assets/js/login.js"></script>
</body>

</html>