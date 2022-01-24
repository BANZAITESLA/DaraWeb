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
    <title>Reset Password</title>
    <link href="assets/css/style.css?" rel="stylesheet">
</head>
<body>
    <?php
        $db = dbConnect();
        if(isset($_POST["Masuk"])) {
            if($db-> connect_errno == 0) {
                $username = $db->escape_string($_POST["username"]);
                $password1 = $db->escape_string($_POST["password1"]);
                $password2 = $db->escape_string($_POST["password2"]);

                $cek_user = "SELECT id_pegawai, nama FROM `pegawai` WHERE id_pegawai = '$username'";
                $res1 = $db->query($cek_user);

                if ($res1) {
                    if($res1 -> num_rows == 1) {
                        $res_pass = "UPDATE pegawai SET `password` = md5('$password1') WHERE id_pegawai = '$username';";
                        $res2 = $db->query($res_pass);
                        if ($res2) {
                            echo '<script type="text/javascript">','resetpassword();','</script>';
                        }
                    } else {
                        echo '<script type="text/javascript">','usersalah();','</script>';
                    } 
                }
            } else {
                echo '<script type="text/javascript">','dberror();','</script>';
            }
        }
    ?>
    <div class="header">DaraWeb.</div>
    <div class="box-reset">
        <div class="title-login">
            Sistem Informasi Absensi Toko Dara Frozen Food
        </div>
        <form id="formLogin" class="form" method="post" action="reset-password.php"> <!-- form login -->
            <div class="form-control">
                <label for="username">ID Pegawai</label>
                <input type="text" placeholder="Masukkan ID Pegawai" id="username" name="username"/>
                <i class="fas fa-exclamation-circle"></i>
                <small></small>  <!-- err msg  -->
            </div>
            <div class="form-control">
                <label for="password">Password Baru</label>
                <input type="password" placeholder="Masukkan Password Baru" id="password1" name="password1"/>
                <i class="fas fa-exclamation-circle"></i>
                <small></small> <!-- err msg  -->
            </div>
            <div class="form-control">
                <label for="password">Ulangi Password Baru</label>
                <input type="password" placeholder="Ulangi Password Baru" id="password2" name="password2"/>
                <i class="fas fa-exclamation-circle"></i>
                <small></small> <!-- err msg  -->
            </div>
            <div class="form-submit">
                <input type="submit" name="Masuk" value="Reset Password"/>
            </div>
        </form>
    </div>
    <script src="assets/js/reset-pw.js"></script>
</body>
</html>