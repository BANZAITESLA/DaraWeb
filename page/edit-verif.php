<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php'); ?>
    <title>Edit Verifikasi</title>
    <?php include_once('../component/script.php'); ?>
</head>

<body>
    <?php include_once('../component/functions.php'); ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Edit Verifikasi Ajuan Izin dan Cuti</div>
        <div class="container-form">
    <?php
        if (isset($_GET["id_perizinan"])) {
            $db=dbConnect();
            if($db->connect_errno==0) {
                $id = $db->escape_string($_GET['id_perizinan']);
                $res = $db->query("SELECT * FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report JOIN pegawai ON izin_cuti.id_pegawai = pegawai.id_pegawai WHERE id_perizinan = '$id';");
                if($res){
                    if($res->num_rows>0){
                        $data=$res->fetch_assoc();
    ?>
                        <form action="" method="post" id="formData" class="form-info">
                            <div class="data-control">
                                <label for="nama">Nama Pegawai</label>
                                <input type="text" name="nama" id="nama" value="<?php echo $data["nama"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="ajuan">Ajuan</label>
                                <input type="text" name="ajuan" id="ajuan" value="<?php echo $data["status"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="tanggal">Tanggal</label>
                                <input type="text" name="tgl" id="tgl" value="<?php echo $data["tanggal_awal_izin"] . ' - ' . $data["tanggal_akhir_izin"]; ?>" readonly/>
                            </div>
                            <div class="data-control">
                                <label for="ket">Keterangan</label>
                                <textarea type="text" name="ket" id="ket" readonly><?php echo $data["keterangan"]; ?></textarea>
                            </div>
                            <div class="data-control">
                                <label for="verif">Verifikasi</label>
                                <select name="verif" id="verif">
                                    <option value="Belum Dikonfirmasi" <?php if ($data["verifikasi"] == "Belum Dikonfirmasi") { echo "selected='selected'"; } ?>>Belum Dikonfirmasi</option>
                                    <option value="Diizinkan" <?php if ($data["verifikasi"] == "Diizinkan") { echo "selected='selected'"; } ?>>Diizinkan</option>
                                    <option value="Tidak Diizinkan" <?php if ($data["verifikasi"] == "Tidak Diizinkan") { echo "selected='selected'"; } ?>>Tidak Diizinkan</option>
                                </select>
                            </div>
                            <div class="submit">
                                <div class="save">
                                    <input type="submit" name="Simpan" value="Simpan" />
                                </div>
                                <div class="cancel">
                                    <a href="ajuan-izin-cuti.php">Batal</a>
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
            let id = <?php echo $_GET["id_perizinan"]; ?>;
            let url = document.location.origin + "/daraweb/page/konfir-verif.php";
            let dest = "ajuan-izin-cuti.php";
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    id : id,
                    verif : $('#verif').val()
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