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
                    $sql = "SELECT * FROM pegawai JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan JOIN status_pegawai ON pegawai.id_status_p = status_pegawai.id_status_p WHERE pegawai.status_aktif = 'Aktif' AND jabatan.nama_jabatan != 'Pemilik Usaha';";
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
                                    <a href="detail-pegawai-aktif.php?id_pegawai=<?php echo $barisdata["id_pegawai"]; ?>" ><button title="Detail"><i class="fas fa-info"></i></button></a>
                                    <a href="edit-pegawai.php?id_pegawai=<?php echo $barisdata["id_pegawai"]; ?>"><button title="Edit"><i class="fas fa-user-edit"></i></button></a>
                                    <a href="berhentikan-pegawai.php?id_pegawai=<?php echo $barisdata["id_pegawai"]; ?>"><button title="Berhentikan" style="background-color: #b31200;" onmouseover="this.style.backgroundColor='#920f00'" onMouseOut="this.style.backgroundColor='#b31200'"><i class="fas fa-user-slash"></i></button></a>
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
    </script>
</body>