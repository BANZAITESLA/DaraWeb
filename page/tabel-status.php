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
        <table id="tabelStatus" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Nama Status Kepegawaian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($db->connect_errno == 0) { /* ketika koneksi db success */
                    $sql = "SELECT * FROM status_pegawai";
                    $res = $db->query($sql);
                    if ($res) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                ?>
                            <tr>
                                <td align="center"></td>
                                <td><?php echo $barisdata["nama_status_p"]; ?></td>
                                <td align="center">
                                    <a href="edit-status.php?id_status=<?php echo $barisdata["id_status_p"]; ?>"><button title="Edit"><i class="fas fa-user-edit"></i></button></a>
                                    <button class="tombolHapus" value="<?php echo $barisdata["id_status_p"]; ?>" title="Hapus" style="background-color: #b31200;" onmouseover="this.style.backgroundColor='#920f00'" onMouseOut="this.style.backgroundColor='#b31200'"><i class="fas fa-trash"></i></button>
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
        var tabelStatus = $('#tabelStatus').DataTable({
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
                    "targets": 2,
                    "orderable": false
                }
            ]
        });

        //nie buat no urut otomatis
        tabelStatus.on('order.dt search.dt', function() {
            tabelStatus.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        //nie event hapus
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
                        var urlHapusStatus = document.location.origin + "/daraweb/page/hapus-status.php?id_status=" + value;
                        $.ajax({
                            /* ajax hapus sesuai id menu */
                            type: 'POST',
                            url: urlHapusStatus,
                            success: function(response) {
                                successMessage("Data berhasil dihapus");

                                //nie buat refresh tabel
                                tabelStatus.draw();
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