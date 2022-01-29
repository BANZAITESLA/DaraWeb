<?php
session_start();
include_once('../component/functions.php');
$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $key = $_GET["key"];
    $cek = "SELECT * FROM lokasi WHERE 'key' = " . $key . ";";
    $res1 = $db->query($cek);
    echo $res1;
    try {
        //code...if ($db->connect_errno == 0) {
        if (isset($_GET['key'])) {


            if ($res1) {
                if ($res1->num_rows == 1) {
                    date_default_timezone_set('Asia/Jakarta'); // CDT
                    $current_time = date('H:i:s');
                    $current_date = date('Y-m-d');
                    $waktu = date('Y-m-d H:i:s');
                    $start = substr(str_replace("-", "", $current_date), 2);
                    $end = substr(str_replace("-", "", $current_date), 2);
                    $id_re = $start . '' . $end . $_SESSION['id_pegawai'] . '03';
                    $periode = substr(str_replace("-", "", $current_date), 2, 2);

                    $day = date("l", $current_date);

                    if ($day == 'Monday') {
                        $day = 'Senin';
                    } else if ($day == 'Tuesday') {
                        $day = 'Selasa';
                    } else if ($day == 'Wednesday') {
                        $day = 'Rabu';
                    } else if ($day == 'Thursday') {
                        $day = 'Kamis';
                    } else if ($day == 'Friday') {
                        $day = 'Jumat';
                    } else if ($day == 'Saturday') {
                        $day = 'Sabtu';
                    } else {
                        $day = 'Minggu';
                    }

                    $jam_hari = "SELECT * FROM `jam_operasional` WHERE hari = '$day';";
                    $res_jam = $db->query($jam_hari);
                    if ($res_jam) {
                        $data_jam = $res_jam->fetch_assoc();
                        $time = [$data_jam['jam_buka'], $data_jam['toleransi']];
                        $sum = strtotime('00:00:00');
                        $totaltime = 0;
                        foreach ($time as $element) {

                            // Converting the time into seconds
                            $timeinsec = strtotime($element) - $sum;

                            // Sum the time with previous value
                            $totaltime = $totaltime + $timeinsec;
                        }
                        $h = intval($totaltime / 3600);
                        $totaltime = $totaltime - ($h * 3600);
                        $m = intval($totaltime / 60);
                        $s = $totaltime - ($m * 60);
                        $a = strtotime("$h:$m:$s");

                        if (strtotime($current_time) > $a) {
                            $status = 'Terlambat';
                        } else {
                            $status = 'Hadir';
                        }
                    }

                    $insert_re = "INSERT INTO `report_event` (`id_report`,`status`, `periode`) VALUES ('$id_re','', '$periode');";
                    $insert_li = "INSERT INTO log_absen (id_pegawai, waktu_absen, id_report) VALUES ('$_SESSION[id_pegawai]', '$waktu', $id_re)";
                    $res1 = $db->query($insert_re);
                    $res2 = $db->query($insert_li);

                    if ($res1 && $res2) {
                        redirect('beranda-pegawai.php');
                    }
                } else {
                    echo "gagal";
                }
            }
            //ini return response tadi
        }
    } catch (\Throwable $th) {
        $arr = array();
        $arr['status'] = "error";
        $arr['message'] = $th;
        $response = json_encode($arr);
        echo $response;
    }
}
