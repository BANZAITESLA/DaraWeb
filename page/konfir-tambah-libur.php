<?php
    include_once('../component/functions.php');
    $db = dbConnect();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($db->connect_errno == 0) {
            try {
                $startDate = $db->escape_string($_POST["startDate"]);
                $endDate = $db->escape_string($_POST["endDate"]);
                $start = str_replace("-", "", $startDate);
                $end = str_replace("-", "", $endDate);
                $id_re = $start . '' . $end;
                $ket = $db->escape_string($_POST["ket"]);
                $periode = substr($end, 2, 2);
    
                $cek_id = "SELECT id_report FROM `tanggal_libur` WHERE id_report = '$id_re';";
                $res3 = $db->query($cek_id);
    
                if ($res3) {
                    if ($res3->num_rows == 1) {
                        $arr = array();
                        $arr['status'] = "error";
                        $arr['message'] = "Duplikat";
                        $response = json_encode($arr);
                        echo $response;
                    } else {
                        $insert_re = "INSERT INTO `report_event` (`id_report`,`status`, `periode`) VALUES ('$id_re','Libur', '$periode');";
                        $insert_li = "INSERT INTO `tanggal_libur` (`tgl_awal_libur`, `tgl_akhir_libur`, `ket`, `id_report`) VALUES ('$startDate', '$endDate', '$ket', '$id_re');";
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