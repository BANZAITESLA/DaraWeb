<head>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php
    include_once('../component/functions.php');
    $db = dbConnect();
    ?>
    <div class="table" id="table">
        <!-- table -->
        <table id="tabelJabatan" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Nama Pegawai</th>
                    <th>Ajuan</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Keterangan</th>
                    <th>Verifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($db->connect_errno == 0) { /* ketika koneksi db success */
                    if(!isset($_POST['thn'])) { /* ketika ada input cari */
                        $sql = "SELECT * FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report JOIN pegawai ON izin_cuti.id_pegawai = pegawai.id_pegawai;";
                    } else { /* ketika tidak ada input cari */
                        $sql = "SELECT * FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report JOIN pegawai ON izin_cuti.id_pegawai = pegawai.id_pegawai WHERE MONTH(izin_cuti.tanggal_awal_izin) = '$_POST[bln]' AND YEAR(izin_cuti.tanggal_awal-izin) = '$_POST[thn]';";
                    }
                    $res = $db->query($sql);
                    if ($res) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                ?>
                            <tr>
                                <td align="center"></td>
                                <td><?php echo $barisdata["nama"]; ?></td>
                                <td><?php echo $barisdata["status"]; ?></td>
                                <td><?php echo $barisdata["tanggal_awal_izin"]; ?></td>
                                <td><?php echo $barisdata["tanggal_akhir_izin"]; ?></td>
                                <td><?php echo $barisdata["keterangan"]; ?></td>
                                <td align="center">
                                    <?php if ($barisdata["verifikasi"] == "Belum Dikonfirmasi") { ?> <i class="fas fa-spinner" style="color: #6A6363"></i>
                                    <?php } else if ($barisdata["verifikasi"] == "Diizinkan") { ?> <i class="fas fa-check" style="color: #09791c"></i>
                                    <?php } else { ?> <i class="fas fa-times" style="color: #b31200"></i> <?php }; ?>
                                </td>
                                <td align="center">
                                    <a href="edit-verif.php?id_perizinan=<?php echo $barisdata["id_perizinan"]; ?>"><button title="Edit"><i class="fas fa-user-edit"></i></button></a>
                                </td>
                            </tr>
                <?php
                        }
                    }
                } else {
                }
                ?>
        </table>
    </div>
    <script>
        //nie inisialisasi datata
        var tabelJabatan = $('#tabelJabatan').DataTable({
            order: [
                [1, 'asc']
            ],
            "language": {
                "url": document.location.origin + "/daraweb/assets/id.json",
            },
            "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                },
                {
                    "targets": 7,
                    "orderable": false
                }
            ]
        });

        //nie buat no urut otomatis
        tabelJabatan.on('order.dt search.dt', function() {
            tabelJabatan.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        //nie event hapus
        const urlReload = document.URL;
        $(".tombolHapus").on('click', function() {
            var value = $(this).attr('value');
            Swal.fire({
                /* validasi hapus data */
                icon: 'question',
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menghapus data ini?",
                confirmButtonText: 'Ya',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                iconColor: '#1e3d59',
                width: '35%',
                color: '#000000',
                confirmButtonColor: '#09791c',
                cancelButtonColor: '#b31200',
            }).then((result) => {
                if (result.isConfirmed) {
                    /* jika user mengklik 'Hapus' */
                    $(function() {
                        var urlHapusJabatan = document.location.origin + "/daraweb/page/hapus-jabatan.php?id_jabatan=" + value;
                        $.ajax({
                            /* ajax hapus sesuai id menu */
                            type: 'POST',
                            url: urlHapusJabatan,
                            success: function(response) {
                                successRedirectMessage("Data berhasil dihapus", urlReload);
                            },
                            error: function(response) {
                                errorMessage(response.message);
                            }
                        })
                    })
                }
            })
        });
    </script>
</body>