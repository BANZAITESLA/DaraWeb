<?php
    include_once('../component/functions.php');
    $db = dbConnect();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($db->connect_errno == 0) {
            try {
                $id = $db->escape_string($_POST["id"]);
                $ket = $db->escape_string($_POST["ket"]);
                $d=strtotime("today");
                $tgl = date("Y-m-d", $d);
                $end = str_replace("-", "", $tgl);
                $id_non = $end . '' . $id;

                $non = "UPDATE pegawai SET status_aktif = 'Non-Aktif' WHERE id_pegawai = '$id'";
                $sql = "INSERT INTO pegawai_non_aktif (id_pegawai_nonaktif, id_pegawai, tgl_berhenti, keterangan) VALUES ('$id_non', '$id', '$tgl', '$ket');";
                $res1 = $db->query($non);
                $res = $db->query($sql);

                if ($res && $res1) {
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