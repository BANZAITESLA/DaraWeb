<?php
include_once("menu-owner.php");
include_once("../component/functions.php");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="assets/css/style.css?v=1.0" rel="stylesheet">
</head>

<body>
    <?php
    menu_owner();
    ?>
    <div class="container-info">
        <div class="head-info">
            Beranda
            <div class="ts">timestamp</div>
        </div>
        <div class="beranda-info">
            <div class="info-rec"></div>
            <div class="info-rec"></div>
            <div class="info-rec"></div>
            <div class="info-grid"></div>
            <div class="info-grid"></div>
            <div class="info-grid"></div>
            <div class="info-grid"></div>
        </div>
    </div>
</body>

</html>