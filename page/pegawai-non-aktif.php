<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Pegawai Non-Aktif</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Data Pegawai Non-Aktif</div>
        <div class="container-form-c">
            <div class="table-f" id="table"></div> <!-- tempat table -->
        </div>
    </div>
    <script>
        $(document).ready(function(){
            load_data();

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"tabel-pegawai-nonaktif.php",
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