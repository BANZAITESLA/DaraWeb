<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Tambah Jabatan</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Tambah Jabatan</div>
        <div class="container-form">
            <form action="" method="post" id="formData" class="form-info">
                <div class="data-control">
                    <label for="nama">Nama Jabatan</label>
                    <input type="text" name="nama" id="nama" required/>
                </div>
                <div class="data-control">
                    <label for="jenis">Jenis Jabatan</label>
                    <input type="text" name="jenis" id="jenis" required/>
                </div>
                <div class="submit">
                    <div class="save">
                        <input type="submit" name="Simpan" value="Simpan" />
                    </div>
                    <div class="cancel">
                        <a href="atur-jabatan.php">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#formData').on('submit', function(e) {
            let url = document.location.origin + "/daraweb/page/konfir-tambah-jabatan.php";
            let dest = "atur-jabatan.php";
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
                    nama : $('#nama').val(),
                    jenis : $('#jenis').val()
                },
                //ni yg dibawah nie biar return datanya type datanya json biar bisa pake titik dibawah response.namavariablenya
                dataType: 'json',
                success: function(response) { //! ni gk tau gimnaaaaaa
                    successRedirectMessage(response.message, dest); 
                    console.log(response.message);
                },
                error: function(response) {
                    errorMessage(response.message);
                    console.log(response.message);
                }
            });
            //ini maksudna yg dibawah biar fungsi pas mencet simpan gk lngung pke fungsi bawaan ke action di formnya tp di batalin jadi di handle sm ajax
            e.preventDefault();
            return false;
        });
    </script>
</body>

</html>