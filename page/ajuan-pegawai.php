<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-pgw.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Pengajuan Izin dan Cuti</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_pgw(); ?>
    <div class="container-all">
        <div class="head-info">Pengajuan Izin dan Cuti</div>
        <div class="container-form-c">
            <div class="head-box-item" style="margin: 20px;">
                    <div class="item-control-mp">
                        <label for="bulan">Bulan</label>
                        <input type="month" id="month_year" name="month_year"/>
                    </div>
                <div class="item-control-mp">
                    <label for="ajuan">Ajuan</label>
                    <select name="ajuan" id="ajuan" style="padding: 2px 0;">
                        <option value="Izin">Izin</option>
                        <option value="Cuti">Cuti</option>
                    </select>
                </div>
                <div class="item-control-mp">
                    <label for="verif">Verifikasi</label>
                    <select name="verif" id="verif" style="padding: 2px 0;">
                        <option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
                        <option value="Diizinkan">Diizinkan</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                    <div class="item-button-z">
                        <a href="tambah-pengajuan.php">Ajukan</a>
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
                    url:"tabel-pengajuan.php",
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