<?php
    include_once('../component/functions.php');
    $db = dbConnect();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($db->connect_errno == 0) {
            try {
                $senin_buka = $db->escape_string($_POST["senin_buka"]);
                $senin_tutup = $db->escape_string($_POST["senin_tutup"]);
                $selasa_buka = $db->escape_string($_POST["selasa_buka"]);
                $selasa_tutup = $db->escape_string($_POST["selasa_tutup"]);
                $rabu_buka = $db->escape_string($_POST["rabu_buka"]);
                $rabu_tutup = $db->escape_string($_POST["rabu_tutup"]);
                $kamis_buka = $db->escape_string($_POST["kamis_buka"]);
                $kamis_tutup = $db->escape_string($_POST["kamis_tutup"]);
                $jumat_buka = $db->escape_string($_POST["jumat_buka"]);
                $jumat_tutup = $db->escape_string($_POST["jumat_tutup"]);
                $sabtu_buka = $db->escape_string($_POST["sabtu_buka"]);
                $sabtu_tutup = $db->escape_string($_POST["sabtu_tutup"]);
                $minggu_buka = $db->escape_string($_POST["minggu_buka"]);
                $minggu_tutup = $db->escape_string($_POST["minggu_tutup"]);
                $toleransi = $db->escape_string($_POST["toleransi"]);

                $sql1 = "UPDATE jam_operasional SET jam_buka = '$senin_buka', jam_tutup = '$senin_tutup', toleransi = '$toleransi' WHERE id_hari = '1';";
                $sql2 = "UPDATE jam_operasional SET jam_buka = '$selasa_buka', jam_tutup = '$selasa_tutup', toleransi = '$toleransi' WHERE id_hari = '2';";
                $sql3 = "UPDATE jam_operasional SET jam_buka = '$rabu_buka', jam_tutup = '$rabu_tutup', toleransi = '$toleransi' WHERE id_hari = '3';";
                $sql4 = "UPDATE jam_operasional SET jam_buka = '$kamis_buka', jam_tutup = '$kamis_tutup', toleransi = '$toleransi' WHERE id_hari = '5';";
                $sql5 = "UPDATE jam_operasional SET jam_buka = '$jumat_buka', jam_tutup = '$jumat_tutup', toleransi = '$toleransi' WHERE id_hari = '6';";
                $sql6 = "UPDATE jam_operasional SET jam_buka = '$sabtu_buka', jam_tutup = '$sabtu_tutup', toleransi = '$toleransi' WHERE id_hari = '7';";
                $sql7 = "UPDATE jam_operasional SET jam_buka = '$minggu_buka', jam_tutup = '$minggu_tutup', toleransi = '$toleransi' WHERE id_hari = '8';";
                $res1 = $db->query($sql1);
                $res2 = $db->query($sql2);
                $res3 = $db->query($sql3);
                $res4 = $db->query($sql4);
                $res5 = $db->query($sql5);
                $res6 = $db->query($sql6);
                $res7 = $db->query($sql7);

                if ($res1 && $res2 && $res3 && $res4 && $res5 && $res6 && $res7) {
                    $arr = array();
                    $arr['status'] = "success";
                    $arr['message'] = "Data berhasil disimpan";
                    $response = json_encode($arr);
                    echo $response;
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