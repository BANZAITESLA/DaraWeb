<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php'); ?>
    <title>Berhentikan Pegawai</title>
    <?php include_once('../component/script.php'); ?>
</head>

<body>
    <?php include_once('../component/functions.php'); ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Berhentikan Pegawai</div>
        <div class="container-form">
    <?php
        if (isset($_GET["id_pegawai"])) {
            $db=dbConnect();
            if($db->connect_errno==0) {
                $id = $db->escape_string($_GET['id_pegawai']);
                $res = $db->query("SELECT * FROM pegawai JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan JOIN status_pegawai ON pegawai.id_status_p = status_pegawai.id_status_p WHERE id_pegawai = '$id';");
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
                            <div class="data-control">
                                <label for="ket">Keterangan Diberhentikan</label>
                                <textarea type="text" name="ket" id="ket" placeholder="isi keterangan..."></textarea>
                            </div>
                            <div class="submit">
                                <div class="stop">
                                    <input type="submit" name="Simpan" value="Berhentikan" />
                                </div>
                                <div class="cancel">
                                    <a href="pegawai-aktif.php">Batal</a>
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
            let url = document.location.origin + "/daraweb/page/konfir-berhenti.php";
            let dest = "pegawai-aktif.php";
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    id : $('#id').val(),
                    ket : $('#ket').val()
                },
                //ni yg dibawah nie biar return datanya type datanya json biar bisa pake titik dibawah response.namavariablenya
                dataType: 'json',
                success: function(response) {
                    successRedirectMessage(response.message, dest)
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