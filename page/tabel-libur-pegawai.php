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
        <table id="tabelLibur" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($db->connect_errno == 0) { /* ketika koneksi db success */
                    if(!isset($_POST['thn'])) { /* ketika ada input cari */
                        $sql = "SELECT * FROM tanggal_libur";
                    } else { /* ketika tidak ada input cari */
                        $sql = "SELECT * from tanggal_libur where MONTH(tgl_awal_libur) = '$_POST[bln]' AND YEAR(tgl_awal_libur) = '$_POST[thn]';";
                    }
                    // if (isset($_GET['filter_bulan']) && $_GET['filter_bulan'] != '') {
                    //     $bln = substr(urldecode($_GET['filter_bulan']), 0, 2);
                    //     $thn =substr(urldecode($_GET['filter_bulan']), 3, 4);
                    //     $sql = "SELECT * from tanggal_libur where MONTH(tgl_awal_libur) = '$bln' AND YEAR(tgl_awal_libur) = '$thn';";
                    // } else {
                    //     $sql = "SELECT * FROM tanggal_libur";

                    // }
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
    </script>
</body>