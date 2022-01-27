<?php
    include_once('../component/functions.php');
$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($db->connect_errno == 0) {
        try {
            $id = $db->escape_string($_POST["id"]);
            $nama = $db->escape_string($_POST["nama"]);
            $jk = $db->escape_string($_POST["jk"]);
            $email = $db->escape_string($_POST["email"]);
            $nohp = $db->escape_string($_POST["nohp"]);
            $alamat = $db->escape_string($_POST["alamat"]);
            $status = $db->escape_string($_POST["status"]);
            $jabatan = $db->escape_string($_POST["jabatan"]);
            $pass = $db->escape_string($_POST["pass"]);
            $d=strtotime("today");
            $tgl = date("Y-m-d", $d);

            $sql = "INSERT INTO pegawai (id_pegawai, nama, jenis_kelamin, no_hp, alamat, tgl_diterima, `password`, id_status_p, id_jabatan, email) VALUES 
                                        ('$id', '$nama', '$jk', '$nohp', '$alamat', '$tgl', md5('$pass'), '$status', '$jabatan', '$email');";
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
