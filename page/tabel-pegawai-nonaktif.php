<head>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php
    include_once('../component/functions.php');
    $db = dbConnect();
    ?>
    <div class="table-f" id="table">
        <!-- table -->
        <table id="tabelPegawai" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>ID Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($db->connect_errno == 0) { /* ketika koneksi db success */
                    $sql = "SELECT * FROM pegawai JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan JOIN status_pegawai ON pegawai.id_status_p = status_pegawai.id_status_p WHERE pegawai.status_aktif = 'Non-Aktif';";
                    $res = $db->query($sql);
                    if ($res) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                ?>
                            <tr>
                                <td align="center"></td>
                                <td><?php echo $barisdata["id_pegawai"]; ?></td>
                                <td><?php echo $barisdata["nama"]; ?></td>
                                <td><?php echo $barisdata["nama_jabatan"]; ?></td>
                                <td><?php echo $barisdata["nama_status_p"]; ?></td>
                                <td align="center">
                                    <a href="detail-pegawai-nonaktif.php?id_pegawai=<?php echo $barisdata["id_pegawai"]; ?>" ><button title="Detail"><i class="fas fa-info"></i></button></a>
                                    <button class="tombolHapus" value="<?php echo $barisdata["id_pegawai"]; ?>" title="Hapus" style="background-color: #b31200;" onmouseover="this.style.backgroundColor='#920f00'" onMouseOut="this.style.backgroundColor='#b31200'"><i class="fas fa-trash"></i></button>
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
        var tabelPegawai = $('#tabelPegawai').DataTable({
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
                    "targets": 5,
                    "orderable": false
                }
            ]
        });

        //nie buat no urut otomatis
        tabelPegawai.on('order.dt search.dt', function() {
            tabelPegawai.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

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
                        var urlHapusJabatan = document.location.origin + "/daraweb/page/hapus-pegawai.php?id_pegawai=" + value;
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