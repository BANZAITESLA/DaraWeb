<?php
include_once('../component/functions.php');
$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($db->connect_errno == 0) {
        if(isset($_GET['id_status'])) {
            try {
                $id = $_GET["id_status"];
                $cek = "SELECT id_status_p FROM pegawai WHERE id_status_p = '$id' AND status_aktif = 'Aktif';";
                $res1 = $db->query($cek);
                    if ($res1) {
                        if ($res1->num_rows == 1) {
                            $arr = array();
                            $arr['status'] = "error";
                            $arr['message'] = "Tidak dapat menghapus data. Pastikan Data tidak dipakai.";
                            $response = json_encode($arr);
                            echo $response;
                        } else {                               
                            $sql = "DELETE FROM status_pegawai WHERE id_status_p = '$id';";
                            $res = $db->query($sql);
                            $arr = array();
                            $arr['status'] = "success";
                            $arr['message'] = "Data berhasil dihapus";
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
}
