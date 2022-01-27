<?php include_once('../component/script.php') ?>
<?php include_once('../component/functions.php') ?>
<?php
$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($db->connect_errno == 0) {
        try {
            $nama = $db->escape_string($_POST["nama"]);
            $jenis = $db->escape_string($_POST["jenis"]);

            $sql = "INSERT INTO `jabatan` (`nama_jabatan`, `jenis_jabatan`) VALUES ('$nama', '$jenis');";
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
