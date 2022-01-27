<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Edit Status</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Edit Status</div>
        <div class="container-form">
    <?php
        if (isset($_GET["id_status"])) {
            $db=dbConnect();
            if($db->connect_errno==0) {
                $id = $db->escape_string($_GET['id_status']);
                $res = $db->query("SELECT * FROM status_pegawai WHERE id_status_p ='$id'");
                if($res){
                    if($res->num_rows>0){
                        $data=$res->fetch_assoc();
    ?>
                        <form action="" method="post" id="formData" class="form-info">
                            <div class="data-control">
                                <label for="nama">Nama Status</label>
                                <input type="text" name="nama" id="nama" value="<?php echo $data["nama_status_p"]; ?>" required/>
                            </div>
                            <div class="submit">
                                <div class="save">
                                    <input type="submit" name="Simpan" value="Simpan" />
                                </div>
                                <div class="cancel">
                                    <a href="atur-status.php">Batal</a>
                                </div>
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

    <script>
        $('#formData').on('submit', function(e) {
            let id = <?php echo $_GET["id_status"]; ?>;
            let url = document.location.origin + "/daraweb/page/konfir-edit-status.php";
            let dest = "atur-status.php";
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
                    id : id,
                    nama : $('#nama').val(),
                },
                //ni yg dibawah nie biar return datanya type datanya json biar bisa pake titik dibawah response.namavariablenya
                dataType: 'json',
                success: function(response) {
                    successRedirectMessage(response.message, dest);
                },
                error: function(response) {
                    errorMessage(response.message);
                }
            });
            //ini maksudna yg dibawah biar fungsi pas mencet simpan gk lngung pke fungsi bawaan ke action di formnya tp di batalin jadi di handle sm ajax
            e.preventDefault();
            return false;
        });
    </script>
</body>

</html>