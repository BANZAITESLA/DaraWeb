<?php
include_once('../component/functions.php');
$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($db->connect_errno == 0) {
            $nama = $db->escape_string($_POST["nama"]);

            $sql = "INSERT INTO `status_pegawai` (`nama_status_p`) VALUES ('$nama');";
            $res = $db->query($sql);

            if ($res) {
                $arr = array();
                $arr['status'] = "success";
                $arr['message'] = "Data berhasil disimpan";
                $response = json_encode($arr);
                echo $response;
            } else {
                $arr = array();
                $arr['status'] = "error";
                $arr['message'] = "";
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
