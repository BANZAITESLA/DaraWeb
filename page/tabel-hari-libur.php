<head>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php
    include_once('../component/functions.php');
    $db = dbConnect();
    ?>
    <div class="table-z" id="table">
        <!-- table -->
        <table id="tabelLibur" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($db->connect_errno == 0) { /* ketika koneksi db success */
                    if (isset($_GET['filter_bulan']) && $_GET['filter_bulan'] != '') {
                        $bln = substr(urldecode($_GET['filter_bulan']), 0, 2);
                        $thn =substr(urldecode($_GET['filter_bulan']), 3, 4);
                        $sql = "SELECT * from tanggal_libur where MONTH(tgl_awal_libur) = '$bln' AND YEAR(tgl_awal_libur) = '$thn';";
                    } else {
                        $sql = "SELECT * FROM tanggal_libur";

                    }
                    $res = $db->query($sql);
                    if ($res) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                ?>
                            <tr>
                                <td align="center"></td>
                                <td><?php echo $barisdata["tgl_awal_libur"]; ?></td>
                                <td><?php echo $barisdata["tgl_akhir_libur"]; ?></td>
                                <td><?php echo $barisdata["ket"]; ?></td>
                                <td align="center">
                                    <a href="edit-hari-libur.php?id_tgl=<?php echo $barisdata["id_tgl"]; ?>"><button title="Edit"><i class="fas fa-user-edit"></i></button></a>
                                    <button class="tombolHapus" value="<?php echo $barisdata["id_tgl"]; ?>" title="Hapus" style="background-color: #b31200;" onmouseover="this.style.backgroundColor='#920f00'" onMouseOut="this.style.backgroundColor='#b31200'"><i class="fas fa-trash"></i></button>
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
        var tabelLibur = $('#tabelLibur').DataTable({
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
                    "targets": 4,
                    "orderable": false
                }
            ]
        });

        //nie buat no urut otomatis
        tabelLibur.on('order.dt search.dt', function() {
            tabelLibur.column(0, {
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
                        var urlHapusLibur = document.location.origin + "/daraweb/page/hapus-libur.php?id_tgl=" + value;
                        $.ajax({
                            /* ajax hapus sesuai id menu */
                            type: 'POST',
                            url: urlHapusLibur,
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