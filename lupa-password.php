<?php
    include_once("functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="assets/css/style.css?v=1.0" rel="stylesheet">
</head>
<body>
    <?php
        $db = dbConnect();
        if(isset($_POST["Kirim"])) {
            if($db-> connect_errno == 0) {
                $email = $db->escape_string($_POST["email"]);

                $cek_user = "SELECT id_pegawai, nama, email FROM `pegawai` WHERE email = '$email'";
                $res1 = $db->query($cek_user);

                if ($res1) {
                    if($res1 -> num_rows == 1) {
                        echo '<script type="text/javascript">',';','</script>'; //terkirim
                    } else {
                        echo '<script type="text/javascript">',';','</script>'; //gagal
                    } 
                }
            } else {
                echo '<script type="text/javascript">','dberror();','</script>';
            }
        }
    ?>
    <div class="header">DaraWeb.</div>
    <div class="box-login">
        <div class="title-login">
            <div style="font-size: 40px;"><i class="fas fa-lock"></i></div><br>
            Lupa Passwordmu?
        </div>
        <form id="formEmail" class="form" method="post" action="#"> 
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
    <script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
    <script src="assets/js/email.js?v=1.0"></script>
</body>
</html>