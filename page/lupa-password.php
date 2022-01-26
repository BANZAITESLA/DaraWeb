<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../component/header.php') ?>
    <title>Lupa Password</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php
        $db = dbConnect();
        if(isset($_POST["Kirim"])) {
            if($db-> connect_errno == 0) {
                $email = $db->escape_string($_POST["email"]);

                $cek_user = "SELECT id_pegawai, nama, email FROM `pegawai` WHERE email = '$email'";
                $res1 = $db->query($cek_user);

                if ($res1) {
                    if($res1 -> num_rows == 1) {
                        echo '<script type="text/javascript">','successMessage("Pesan Reset Password telah dikirim ke Emailmu");','</script>'; //terkirim
                    } else {
                        echo '<script type="text/javascript">','errorMessage("Pesan Reset Password tidak dapat dikirim. Gunakan Email yang telah terdaftar!");','</script>'; //gagal
                    } 
                }
            } else {
                echo '<script type="text/javascript">','errorMessage("Tidak dapat terhubung ke Database. Hubungi Administrator.");','</script>';
            }
        }
    ?>
    <div class="header">DaraWeb.</div>
    <div class="box-login">
        <div class="title-login">
            <div style="font-size: 40px;"><i class="fas fa-lock"></i></div><br>
            Lupa Passwordmu?
        </div>
        <form id="formEmail" class="form" method="post" action="lupa-password.php"> 
            <div class="form-control">
                <input type="text" placeholder="Masukkan Email" id="email" name="email"/>
                <i class="fas fa-exclamation-circle"></i>
                <small></small> 
            </div>
            <div class="form-submit">
                <input type="submit" name="Kirim" value="Kirim"/>
            </div>
        </form>
    </div>
    <script src="../assets/js/email.js"></script>
</body>