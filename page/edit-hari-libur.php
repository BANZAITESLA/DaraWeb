<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../component/header.php') ?>
    <title>Edit Hari Libur</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Edit Hari Libur</div>
        <div class="container-form">
    <?php
        if (isset($_GET["id_tgl"])) {
            $db=dbConnect();
            if($db->connect_errno==0) {
                $id = $db->escape_string($_GET['id_tgl']);
                $res = $db->query("SELECT * FROM tanggal_libur WHERE id_tgl ='$id'");
                if($res){
                    if($res->num_rows>0){
                        $data=$res->fetch_assoc();
    ?>
                        <form action="" method="post" id="formData" class="form-info">
                            <div class="data-control">
                                <label for="tanggal">Tanggal Libur</label>
                                <input type="text" id="tanggal_libur" value="<?php echo $data['tgl_awal_libur'] . ' - ' . $data['tgl_akhir_libur']; ?>" readonly />
                            </div>
                            <div class="data-control">
                                <label for="ket">Keterangan</label>
                                <input type="text" id="ket" name="ket" value="<?php echo $data['ket']?>" required />
                            </div>
                            <div class="submit">
                                <div class="save">
                                    <input type="submit" name="Simpan" value="Simpan" />
                                </div>
                                <div class="cancel">
                                    <a href="atur-absensi.php">Batal</a>
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
        //bikin dilu event submitnya
        $('#formData').on('submit', function(e) {
            // if ($('#ket').val() === "") {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Kesalahan',
            //         text: 'Tidak dapat menyimpan data. Pastikan data tidak duplikat.',
            //         confirmButtonText: 'Ok',
            //         iconColor: '#b31200',
            //         width: '35%',
            //         color: '#000000',
            //         confirmButtonColor: '#1e3d59',
            //     })
            // }
            let url = document.location.origin + "/daraweb/page/konfir-edit-libur.php";
            let id = <?php echo $_GET['id_tgl']; ?>;
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
                    id: id,
                    ket: $('#ket').val()
                },
                //ni yg dibawah nie biar return datanya type datanya json biar bisa pake titik dibawah response.namavariablenya
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'error') {
                        errorMessage(response.message);
                    } else {
                        succesMessage(response.message);
                    }
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