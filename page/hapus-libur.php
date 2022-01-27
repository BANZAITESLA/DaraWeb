<?php include_once('../component/script.php') ?>
<?php include_once('../component/functions.php') ?>
<?php
$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($db->connect_errno == 0) {
        if(isset($_GET['id_tgl'])) {
            try {
                $id = $_GET["id_tgl"];

                $sql = "DELETE FROM report_event WHERE id_report = (SELECT id_report FROM tanggal_libur WHERE id_tgl = '$id');";
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
