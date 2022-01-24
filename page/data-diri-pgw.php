<?php
    include_once("menu-pgw.php");
    include_once("functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Diri</title>
    <link href="assets/css/style.css?" rel="stylesheet">
</head>
<body>
    <?php
        menu_pgw();
    ?>
    <div class="head-info">Data Diri</div>
    <div class="container-info">
        <div class="box-info"></div>
        <form action="data-diri.php" method="post" id="formData" class="form-info">
            <div class="data-control">
                <label for="username">ID Pegawai</label>
                <input type="text" id="username" name="username" value=""/>
            </div>
            <div class="data-control">
                <label for="nama">Nama Pegawai</label>
                <input type="text" id="nama" name="nama" value=""/>
            </div>
            <div class="data-control">
                <label for="jk">Jenis Kelamin</label>
                <input type="text" id="jk" name="jk" value=""/>
            </div>
            <div class="data-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value=""/>
            </div>
            <div class="data-control">
                <label for="nohp">No HP</label>
                <input type="text" id="nohp" name="nohp" value=""/>
            </div>
            <div class="data-control">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value=""/>
            </div>
            <div class="data-control">
                <label for="status">Status Pekerja</label>
                <input type="text" id="status" name="status" value=""/>
            </div>
            <div class="data-control">
                <label for="jabatan">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" value=""/>
            </div>
            <div class="data-control">
                <label for="password">Password</label>
                <input type="password" placeholder="isi jika ingin mengganti password" id="password" name="password"/>
            </div>
            <div class="data-submit">
                <input type="submit" name="Simpan" value="Simpan"/>
            </div>
        </form>
    </div>
</body>
</html>