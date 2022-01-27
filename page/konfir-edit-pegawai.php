<?php include_once('../component/script.php') ?>
<?php include_once('../component/functions.php') ?>
<?php
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

                if ($pass == '') {
                    $sql = "UPDATE pegawai SET nama = '$nama', jenis_kelamin = '$jk', email = '$email', no_hp = '$nohp', alamat = '$alamat', id_status_p = '$status', id_jabatan = '$jabatan' WHERE id_pegawai = '$id';";
                } else {
                    $sql = "UPDATE pegawai SET nama = '$nama', jenis_kelamin = '$jk', email = '$email', no_hp = '$nohp', alamat = '$alamat', id_status_p = '$status', id_jabatan = '$jabatan', password = md5('$pass') WHERE id_pegawai = '$id';";
                }

                $res = $db->query($sql);

                if ($res) {
                    $arr = array();
                    $arr['status'] = "success";
                    $arr['message'] = "Berhasil Disimpan";
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