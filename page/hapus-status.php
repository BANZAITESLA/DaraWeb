<?php include_once('../component/script.php') ?>
<?php include_once('../component/functions.php') ?>
<?php
$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($db->connect_errno == 0) {
        if(isset($_GET['id_status'])) {
            try {
                $id = $_GET["id_status"];
    
                $sql = "DELETE FROM status_pegawai WHERE id_status_p = '$id';";
                $res = $db->query($sql);
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
