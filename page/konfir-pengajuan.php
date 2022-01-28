<?php
    session_start();
    include_once('../component/functions.php');
    $db = dbConnect();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($db->connect_errno == 0) {
            try {
                $id = $db->escape_string($_SESSION["id_pegawai"]);
                $ajuan = $db->escape_string($_POST["ajuan"]);
                $ket = $db->escape_string($_POST["ket"]);
                $startDate = $db->escape_string($_POST["startDate"]);
                $endDate = $db->escape_string($_POST["endDate"]);
                $start = substr(str_replace("-", "", $startDate), 2);
                $end = substr(str_replace("-", "", $endDate), 2);
                $id_re = $start . '' . $end . $id .'02';
                $periode = substr(str_replace("-", "", $endDate), 2, 2);;
    
                $cek_id = "SELECT id_report FROM `izin_cuti` WHERE id_report = '$id_re';";
                $res3 = $db->query($cek_id);
    
                if ($res3) {
                    if ($res3->num_rows == 1) {
                        $arr = array();
                        $arr['status'] = "error";
                        $arr['message'] = "Tidak dapat menyimpan data. Pastikan Data tidak duplikat.";
                        $response = json_encode($arr);
                        echo $response;
                    } else {
                        $insert_re = "INSERT INTO `report_event` (`id_report`,`status`, `periode`) VALUES ('$id_re','$ajuan', '$periode');";
                        $insert_li = "INSERT INTO `izin_cuti` (`id_pegawai`, `tanggal_awal_izin`, `tanggal_akhir_izin`, `verifikasi`, `keterangan`, `id_report`) VALUES 
                                                                ('$id', '$startDate', '$endDate', 'Belum Dikonfirmasi', '$ket', '$id_re');";
                        $res1 = $db->query($insert_re);
                        $res2 = $db->query($insert_li);
    
                        $arr = array();
                        $arr['status'] = "success";
                        $arr['message'] = "Data berhasil disimpan";
                        $response = json_encode($arr);
                        echo $response;
                    }
                }
    
                //ini return response tadi
            } catch (\Throwable $th) {
                //ini mengembalikan semua kemungkinan error
                $arr = array();
                $arr['status'] = "error";
                $arr['message'] = $th;
                $response = json_encode($arr);
                echo $response;
            }
            exit();
        }
    }
?>