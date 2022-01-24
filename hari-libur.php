<?php
    include_once("menu-pgw.php");
    include_once("functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login DaraWeb</title>
    <link href="assets/css/style.css?v=1.0" rel="stylesheet">
</head>
<body>
    <?php
        menu_pgw();
    ?>
    <div class="head-info">Hari Libur</div>
    <div class="head-cog">
        <form action="hari-libur.php">
            <label for="bulan">Bulan</label>
            <input type="date">
        </form>
    </div>
</body>
</html>