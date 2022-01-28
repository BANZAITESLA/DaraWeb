<?php
    session_start();
?>
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
                    <th>Waktu Absen</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($db->connect_errno == 0) { /* ketika koneksi db success */
                    // if(!isset($_POST['thn'])) { /* ketika ada input cari */
                    //     $sql = "SELECT * FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report JOIN pegawai ON izin_cuti.id_pegawai = pegawai.id_pegawai;";
                    // } else { /* ketika tidak ada input cari */
                    //     $sql = "SELECT * FROM izin_cuti JOIN report_event ON izin_cuti.id_report = report_event.id_report JOIN pegawai ON izin_cuti.id_pegawai = pegawai.id_pegawai WHERE MONTH(izin_cuti.tanggal_awal_izin) = '$_POST[bln]' AND YEAR(izin_cuti.tanggal_awal-izin) = '$_POST[thn]';";
                    // }
                    $d=strtotime("today");
                    $tgl = date("Y-m-d", $d);
                    // $day = date("l", $d);
                    // if ($day == 'Monday') {
                    //     $day = 'Senin';
                    // } else if ($day == 'Tuesday') {
                    //     $day = 'Selasa';
                    // } else if ($day == 'Wednesday') {
                    //     $day = 'Rabu';
                    // } else if ($day == 'Thursday') {
                    //     $day = 'Kamis';
                    // } else if ($day == 'Friday') {
                    //     $day = 'Jumat';
                    // } else if ($day == 'Saturday') {
                    //     $day = 'Sabtu';
                    // } else {
                    //     $day = 'Minggu';
                    // }

                    $sql = "SELECT log_absen.waktu_absen, report_event.status FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report WHERE DATE_FORMAT(log_absen.waktu_absen, '%Y-%m-%d') = '$tgl' AND log_absen.id_pegawai = '$_SESSION[id_pegawai]';";
                    $res = $db->query($sql);
                    // $jam_hari = "SELECT * FROM `jam_operasional` WHERE hari = '$day';";
                    // $res_jam = $db->query($jam_hari);
                    if ($res) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                ?>
                            <tr>
                                <td align="center"></td>
                                <td><?php echo $barisdata["waktu_absen"]; ?></td>
                                <td>
                                    <?php
                                        echo $barisdata["status"];
                                        // if ($barisdata["status"] == 'Terlambat') {
                                        //     if ($res_jam) {
                                        //         $data_jam = $res_jam->fetch_assoc();
                                        //         // $time = [$data_jam['jam_buka'], $data_jam['toleransi']];
                                        //         // $sum = strtotime('00:00:00');
                                        //         // $totaltime = 0;
                                        //         // foreach( $time as $element ) {
     
                                        //         //     // Converting the time into seconds
                                        //         //     $timeinsec = strtotime($element) - $sum;
                                                     
                                        //         //     // Sum the time with previous value
                                        //         //     $totaltime = $totaltime + $timeinsec;
                                        //         // }
                                        //         // $h = intval($totaltime / 3600);                                       
                                        //         // $totaltime = $totaltime - ($h * 3600);
                                        //         // $m = intval($totaltime / 60);
                                        //         // $s = $totaltime - ($m * 60);
                                                
                                        //         //Printing the result
                                        //         echo $barisdata['status'] . "";
                                        //     }
                                        // } else {
                                        //     echo $barisdata["status"];
                                        // }
                                    ?>
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
    </script>
</body>