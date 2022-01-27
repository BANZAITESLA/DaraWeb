<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Detail Pegawai</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Detail Data Pegawai</div>
        <div class="container-form">
    <?php
        if (isset($_GET["id_pegawai"])) {
            $db=dbConnect();
            if($db->connect_errno==0) {
                $id = $db->escape_string($_GET['id_pegawai']);
                $res = $db->query("SELECT * FROM pegawai JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan JOIN status_pegawai ON pegawai.id_status_p = status_pegawai.id_status_p;");
                if($res){
                    if($res->num_rows>0){
                        $data=$res->fetch_assoc();
    ?>
                        <form action="" method="post" id="formData" class="form-info">
                            <div class="data-control">
                                <label for="id">ID Pegawai</label>
                                <input type="text" name="id" id="id" value="<?php echo $data["id_pegawai"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="nama">Nama Pegawai</label>
                                <input type="text" name="nama" id="nama" value="<?php echo $data["nama"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="jk">Jenis Kelamin</label>
                                <input type="text" name="jk" id="jk" value="<?php echo $data["jenis_kelamin"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="<?php echo $data["email"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="nohp">No HP</label>
                                <input type="text" name="nohp" id="nohp" value="<?php echo $data["no_hp"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="alamat">Alamat</label>
                                <textarea type="text" name="alamat" id="alamat" readonly><?php echo $data["alamat"]; ?></textarea>
                            </div>
                            <div class="data-control">
                                <label for="tanggal">Tanggal Diterima</label>
                                <input type="text" name="tgl" id="tgl" value="<?php echo $data["tgl_diterima"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="status">Status Pekerja</label>
                                <input type="text" name="status" id="status" value="<?php echo $data["nama_status_p"]; ?>" readonly/>
                            </div>
                        </form>
    <?php
                    } else {
                        echo '<script type="text/javascript">', 'errorRedirectMessage("Data tidak ditemukan", "atur-jabatan.php");', '</script>';
                    }
                }
            } else {
                echo '<script type="text/javascript">', 'errorMessage("Tidak dapat terhubung ke Database. Hubungi Administrator.");', '</script>';
            }
        }
    ?>
        </div>
    </div>
</body>

</html>