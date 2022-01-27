<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Tambah Pegawai</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Tambah Data Pegawai</div>
        <div class="container-form">
    <?php
            $db=dbConnect();
            if($db->connect_errno==0) {
    ?>
                <form action="" method="post" id="formData" class="form-info">
                    <div class="data-control">
                        <label for="nama">Nama Pegawai</label>
                        <input type="text" name="nama" id="nama" required/>
                    </div>
                    <div class="data-control">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="jk">
                            <option value="Perempuan"?>Perempuan</option>
                            <option value="Laki-Laki"?>Laki-Laki</option>
                        </select>
                    </div>
                    <div class="data-control">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required/>
                    </div>
                    <div class="data-control">
                        <label for="nohp">No HP</label>
                        <input type="text" name="nohp" id="nohp" required/>
                    </div>
                    <div class="data-control">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" name="alamat" id="alamat" required></textarea>
                    </div>
                    <div class="data-control">
                        <label for="status">Status Pekerja</label>
                        <select name="status" id="status">
                            <?php
                                $cek_status = $db -> query("SELECT * FROM `status_pegawai` ORDER BY id_status_p;");
                                if ($cek_status) {
                                    $data_status = $cek_status -> fetch_all(MYSQLI_ASSOC);
                                    foreach ($data_status as $datastatus) {
                                        echo "<option value=\"" . $datastatus["id_status_p"] . "\"";
                                        echo ">" . $datastatus["nama_status_p"] . "</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="data-control">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan">
                            <?php
                                $cek_jabatan = $db -> query("SELECT * FROM `jabatan` ORDER BY id_jabatan;");
                                if ($cek_jabatan) {
                                    $data_jabatan = $cek_jabatan -> fetch_all(MYSQLI_ASSOC);
                                    foreach ($data_jabatan as $datajabatan) {
                                        echo "<option value=\"" . $datajabatan["id_jabatan"] . "\"";
                                        echo ">" . $datajabatan["nama_jabatan"] . "</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="data-control">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" required/>
                    </div>
                    <div class="submit">
                        <div class="save">
                            <input type="submit" name="Simpan" value="Simpan" />
                        </div>
                        <div class="cancel">
                            <a href="pegawai-aktif.php">Batal</a>
                        </div>
                    </div>
                </form>
    <?php
            } else {
                echo '<script type="text/javascript">', 'errorMessage("Tidak dapat terhubung ke Database. Hubungi Administrator.");', '</script>';
            }
    ?>
        </div>
    </div>

    <script>
        $('#formData').on('submit', function(e) {
            let url = document.location.origin + "/daraweb/page/konfir-tambah-pegawai.php";
            let dest = "pegawai-aktif.php";
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    id : id,
                    nama : $('#nama').val(),
                    jk : $('#jk').val(),
                    email : $('#email').val(),
                    nohp : $('#nohp').val(),
                    alamat : $('#alamat').val(),
                    status : $('#status').val(),
                    jabatan : $('#jabatan').val(),
                    pass : $('#pass').val()
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