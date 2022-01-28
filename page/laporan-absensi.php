<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Laporan Absensi</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Laporan Absensi</div>
        <div class="container-form-c">
            <div class="head-box-item" style="margin: 20px;">
                    <div class="item-control-mp">
                        <label for="bulan">Bulan</label>
                        <input type="month" id="month_year" name="month_year"/>
                    </div>
                    <div class="item-control-mp">
                        <label for="bulan">Jumlah kehadiran penuh : <?php ; ?> hari</label>
                    </div>
                </div>
            <div class="table" id="table"></div> <!-- tempat table -->
        </div>
    </div>
    <script>
        $(document).ready(function(){
            load_data();

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"tabel-laporan.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#table').html(data);
                    }
                });
            }
        });

        $('#month_year').on('input', function() { /* jquery ketika terdapat input cari */
                console.log($(this).val());
                var pencarian = $(this).val();
                let thn = pencarian.substring(0, 4);
                let bln = pencarian.substring(5, 8);
                console.log(thn);
                console.log(bln);
                if(pencarian != '') {
                    $.ajax({
                        url: "tabel-ajuan.php",
                        method: "POST",
                        data: {
                            thn: thn,
                            bln: bln
                        },
                        success: function(data) {
                            $('#table').html(data);
                        }
                    });
                } else {
                    load_data();
                }
            });
    </script>
</body>

</html>