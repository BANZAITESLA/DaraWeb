<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../page/menu-owner.php"); ?>
    <?php include_once('../component/header.php') ?>
    <title>Log Absensi</title>
    <?php include_once('../component/script.php') ?>
</head>

<body>
    <?php include_once('../component/functions.php') ?>
    <?php 
        menu_owner();     
        $db = dbConnect();
    ?>
    <div class="container-all">
        <div class="head-info">Log Absensi</div>
        <div class="container-form-c">
            <div class="head-box-item" style="margin: 20px;">
                    <div class="item-control-mp">
                        <label for="bulan">Tanggal</label>
                        <input type="date" id="month_year" name="month_year"/>
                    </div>
                </div>
                <div class="table" id="table">
        <!-- table -->
        <table id="tabelJabatan" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Waktu Absen</th>
                    <th>Nama Pegawai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $d=strtotime("today");
                    $tgl = date("Y-m-d", $d);
                    if ($db->connect_errno == 0) { /* ketika koneksi db success */
                        if (isset($_GET['filter_tanggal']) && $_GET['filter_tanggal'] != '') {
                            $tgl = substr($_GET['filter_tanggal'], 8, 2);
                            $bln = substr($_GET['filter_tanggal'], 5, 2);
                            $thn = substr($_GET['filter_tanggal'], 0, 4);
                            $sql = "SELECT log_absen.waktu_absen, report_event.status FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report WHERE DAY(waktu_absen) = '$tgl' AND MONTH(waktu_absen) = '$bln' AND YEAR(waktu_absen) = '$thn';";
                        } else {
                            $sql = "SELECT log_absen.waktu_absen, report_event.status FROM log_absen JOIN report_event ON log_absen.id_report = report_event.id_report WHERE DATE_FORMAT(log_absen.waktu_absen, '%Y-%m-%d') = '$tgl';";
                        }
                        $res = $db->query($sql);
                        if ($res) {
                            $data = $res->fetch_all(MYSQLI_ASSOC);
                            $i = 1;
                            foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                    ?>
                                <tr>
                                    <td align="center"></td>
                                    <td><?php echo $barisdata["waktu_absen"]; ?></td>
                                    <td><?php echo $barisdata["nama"]; ?></td>
                                    <td>
                                        <?php
                                            echo $barisdata["status"];
                                            // $jam_hari = "SELECT * FROM `jam_operasional` WHERE hari = '$day';";
                                            // $res_jam = $db->query($jam_hari);
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
        </div>
    </div>
    <script>
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

        let urlFilter = document.URL;
        let thn = new URL(document.URL);
        let filter = thn.searchParams.get("filter_tanggal");
        $('#month_year').val(filter ?? '');
        $('#month_year').on('change', function() {
            urlFilter = updateURLParameter(urlFilter, 'filter_tanggal', $(this).val());
            window.location.href = urlFilter;
        });
    </script>
</body>

</html>