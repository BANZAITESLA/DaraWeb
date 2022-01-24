<?php
    include_once("menu-owner.php");
    include_once("functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login DaraWeb</title>
    <link href="assets/css/style.css?" rel="stylesheet">
</head>
<body>
    <?php
        menu_owner();
    ?>
    <div class="container-all">
        <div class="head-info">Pengaturan Absensi</div>
        <div class="container-absen">
            <div class="box-item">
                <div style="font-size: 16px; font-weight:500;">Atur Hari Libur</div>
                <div class="head-box-item">
                    <div class="item-control">
                        <input type="text" placeholder="Cari Tanggal" id="cari"/>
                        <i class='fas fa-search'></i>
                    </div>
                    <div class="item-control-mp">
                        <label for="bulan"> Bulan</label>
                        <input type="month" id="start" name="start" min="2022-01"/>
                    </div>
                    <div class="item-button">
                        <a href="tambah-hari-libur.php">Tambah</a>
                    </div>
                </div>
                <div class="table" id="table"></div> <!-- tempat table -->
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
                    url:"KK-tabel-menu.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#table').html(data);
                    }
                });
            }

            $('#cari').keyup(function() { /* jquery ketika terdapat input cari */
                var pencarian = $(this).val();
                if(pencarian != '') {
                    load_data(pencarian);
                } else {
                    load_data();
                }
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
</body>
</html>