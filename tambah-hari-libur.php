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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="assets/css/style.css?v=1.0" rel="stylesheet">
</head>

<body>
    <?php
    menu_owner();
    ?>
    <div class="container-all">
        <div class="head-info">Tambah Hari Libur</div>
        <div class="container-form">
            <form action="" method="post" id="formData" class="form-info">
                <div class="data-control">
                    <label for="tanggal">Tanggal Libur</label>
                    <input type="text" placeholder="klik untuk mengisi tanggal" name="daterange" id="tanggal_libur" required readonly />
                </div>
                <div class="data-control">
                    <label for="ket">Keterangan</label>
                    <input type="text" id="ket" name="ket" required />
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
        </div>
    </div>
    <script>
        //variable buat ditampung buat ntr dikirim
        let tanggalAwal;
        let tanggalAkhir;

        //ini inisialisasi daterangepicker
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            format: 'DD-MM-YYYY',
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        }, function(start, end) {
            //dri event milih tanggal daterangepicker diisi variable tampung di atas
            tanggalAwal = start.format('YYYY-MM-DD');
            tanggalAkhir = end.format('YYYY-MM-DD');
        });

        //ini fungsi ketika mencet apply
        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        //ini fungsi ketika mencet cancel daterange
        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        //bikin dilu event submitnya
        $('#formData').on('submit', function(e) {
            if ($('#ket').val() === "") {
                Swal.fire({
                        icon : 'error',
                        title : 'Kesalahan',
                        text : 'Tidak dapat menyimpan data. Pastikan data tidak duplikat.',
                        confirmButtonText: 'Ok',
                        iconColor : '#b31200',
                        width : '35%',
                        color : '#000000',
                        confirmButtonColor : '#1e3d59',
                    })
            }
            let url = document.location.origin + "/daraweb/konfirmasi-tambah-hari-libur.php";
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
                    startDate: tanggalAwal,
                    endDate: tanggalAkhir,
                    ket: $('#ket').val()
                },
                //ni yg dibawah nie biar return datanya type datanya json biar bisa pake titik dibawah response.namavariablenya
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon : 'success',
                        title : 'Berhasil',
                        text : 'Data berhasil disimpan',
                        confirmButtonText: 'Ok',
                        width : '35%',
                        color : '#000000',
                    })
                },
                error: function(response) {
                    Swal.fire({
                        icon : 'error',
                        title : 'Kesalahan',
                        text : 'Tidak dapat menyimpan data. Pastikan data tidak duplikat.',
                        confirmButtonText: 'Ok',
                        iconColor : '#b31200',
                        width : '35%',
                        color : '#000000',
                        confirmButtonColor : '#1e3d59',
                    })
                }
            });
            //ini maksudna yg dibawah biar fungsi pas mencet simpan gk lngung pke fungsi bawaan ke action di formnya tp di batalin jadi di handle sm ajax
            e.preventDefault();
            return false;
        });
    </script>
</body>

</html>