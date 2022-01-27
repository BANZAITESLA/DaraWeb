<?php
include_once('../component/functions.php');
$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($db->connect_errno == 0) {
        try {
            $id = $db->escape_string($_POST["pegawai"]);
            $long = $db->escape_string($_POST["long"]);
            $lat = $db->escape_string($_POST["lat"]);

            $sql = "UPDATE `lokasi` SET id_pegawai = $id, longitude = $long, latitude = $lat WHERE id_lokasi = '1';";
            $res = $db->query($sql);

            if ($res) {
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
