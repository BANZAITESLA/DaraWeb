<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../component/header.php') ?>
    <title>Data Diri</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php
        $db=dbConnect();
        if($db->connect_errno==0) {
            // if (isset($_POST["Simpan"])) {
            //     //cek
            // }
    ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Data Diri</div>
        <div class="container-form">
            <form action="data-diri-owner.php" method="post" id="formData" class="form-info">
            <?php
                $res = $db->query("SELECT * FROM pegawai WHERE id_pegawai='$_SESSION[id_pegawai]'");
                if($res) {
                    if($res -> num_rows > 0) {
                        $data = $res -> fetch_assoc();
                        $res -> free();
            ?>
                        <div class="data-control">
                                <label for="id">ID Pegawai</label>
                                <input type="text" name="id" id="id" value="<?php echo $data["id_pegawai"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="nama">Nama Pegawai</label>
                                <input type="text" name="nama" id="nama" value="<?php echo $data["nama"]; ?>"/>
                            </div>
                            <div class="data-control">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk">
                                    <option value="Perempuan" <?php if ($data["jenis_kelamin"] == "Perempuan") { echo "selected='selected'"; } ?> >Perempuan</option>
                                    <option value="Laki-Laki" <?php if ($data["jenis_kelamin"] == "Laki-Laki") { echo "selected='selected'"; } ?> >Laki-Laki</option>
                                </select>
                            </div>
                            <div class="data-control">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo $data["email"]; ?>"/>
                            </div>
                            <div class="data-control">
                                <label for="nohp">No HP</label>
                                <input type="text" name="nohp" id="nohp" value="<?php echo $data["no_hp"]; ?>"/>
                            </div>
                            <div class="data-control">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" value="<?php echo $data["alamat"]; ?>"/>
                            </div>
                            <div class="data-control">
                                <label for="password">Password</label>
                                <input type="password" placeholder="isi jika ingin mengganti password" name="password" id="password" value=""/>
                            </div>
            <?php
                    } else {
                        echo '<script type="text/javascript">', 'errorMessage("Data tidak ditemukan.");', '</script>';
                    }
                }
        } else {
            echo '<script type="text/javascript">', 'errorMessage("Tidak dapat terhubung ke Database. Hubungi Administrator.");', '</script>';
        }

            ?>
                <div class="data-submit">
                    <input type="submit" name="Simpan" value="Simpan"/>
                </div>
            </form>
        </div>
    </div>
</body>

</html>