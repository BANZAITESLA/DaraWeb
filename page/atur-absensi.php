<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../component/header.php') ?>
    <title>Pengaturan Absensi</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Pengaturan Absensi</div>
        <div class="container-absen">
            <div class="box-item">
                <div style="font-size: 16px; font-weight:500;">Atur Hari Libur</div>
                <div class="head-box-item">
                    <div class="item-control-mp">
                        <label for="bulan"> Bulan</label>
                        <input type="month" id="start" name="start" min="2022-01"/>
                    </div>
                    <div class="item-button-z">
                        <a href="tambah-hari-libur.php">Tambah</a>
                    </div>
                </div>
                <div class="table-z" id="table"></div> <!-- tempat table -->
            </div>
            <div class="box-item"></div>
            <div class="box-item"></div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            load_data();

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"tabel-hari-libur.php",
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