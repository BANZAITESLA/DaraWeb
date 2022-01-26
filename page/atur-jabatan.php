<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../component/header.php') ?>
    <title>Pengaturan Jabatan</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Pengaturan Jabatan</div>
        <div class="container-form-c">
            <div class="item-button">
                <a href="tambah-jabatan.php">Tambah</a>
            </div>
            <div class="table" id="table"></div> <!-- tempat table -->
        </div>
    </div>
    <script>
        $(document).ready(function(){
            load_data();

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"tabel-jabatan.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#table').html(data);
                    }
                });
            }
        });
    </script>
</body>

</html>