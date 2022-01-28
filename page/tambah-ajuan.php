<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Tambah Ajuan</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php menu_owner(); ?>
    <div class="container-all">
        <div class="head-info">Tambah Ajuan Izin dan Cuti</div>
        <div class="container-form">
        <?php
            $db=dbConnect();
            if($db->connect_errno==0) {
        ?>
            <form action="" method="post" id="formData" class="form-info">
                <div class="data-control">
                    <label for="nama">Nama Pegawai</label>
                    <select name="nama" id="nama">
                        <?php
                            $cek_nama = $db -> query("SELECT id_pegawai, nama FROM `pegawai` WHERE status_aktif = 'Aktif' ORDER BY nama;");
                            if ($cek_nama) {
                                $data_nama = $cek_nama -> fetch_all(MYSQLI_ASSOC);
                                foreach ($data_nama as $datanama) {
                                    echo "<option value=\"" . $datanama["id_pegawai"] . "\"";
                                    echo ">" . $datanama["nama"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="data-control">
                    <label for="ajuan">Ajuan</label>
                    <select name="ajuan" id="ajuan">
                        <option value="Izin">Izin</option>
                        <option value="Cuti">Cuti</option>
                    </select>
                </div>
                <div class="data-control">
                    <label for="tanggal">Tanggal Libur</label>
                    <input type="text" placeholder="klik untuk mengisi tanggal" name="daterange" id="tanggal_libur" required readonly />
                </div>
                <div class="data-control">
                    <label for="verif">Verifikasi</label>
                    <select name="verif" id="verif">
                        <option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
                        <option value="Diizinkan">Diizinkan</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="data-control">
                    <label for="ket">Keterangan</label>
                    <textarea type="text" name="ket" id="ket" required></textarea>
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
                echo '<script type="text/javascript">', 'errorMessage("Tidak dapat terhubung ke Database. Hubungi Administrator.");', '</script>';
            }
        ?>
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
            let url = document.location.origin + "/daraweb/page/konfir-tambah-ajuan.php";
            let dest = "ajuan-izin-cuti.php";
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    //data nya yg dimasukin buat diterima di file konfirmasi-tambah-hari-libur
                    id: $('#nama').val(),
                    ajuan: $('#ajuan').val(),
                    startDate: tanggalAwal,
                    endDate: tanggalAkhir,
                    verif: $('#verif').val(),
                    ket: $('#ket').val()
                },
                //ni yg dibawah nie biar return datanya type datanya json biar bisa pake titik dibawah response.namavariablenya
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'error') {
                        errorMessage(response.message);
                    } else {
                        successRedirectMessage(response.message, dest);
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