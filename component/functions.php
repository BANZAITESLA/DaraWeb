<?php
function dbConnect()
{ /* function untuk koneksi ke db */
    $db = new mysqli("localhost", "root", "", "daraweb");
    return $db;
}

function redirect($url)
{ /* function untuk redirect url jika header tidak berfungsi */
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit;
    }
}

function hari($today) {
    $day = date("l", $today);

    if ($day == 'Monday') {
        return 'Senin';
    } else if ($day == 'Tuesday') {
        return 'Selasa';
    } else if ($day == 'Wednesday') {
        return 'Rabu';
    } else if ($day == 'Thursday') {
        return 'Kamis';
    } else if ($day == 'Friday') {
        return 'Jumat';
    } else if ($day == 'Saturday') {
        return 'Sabtu';
    } else {
        return 'Minggu';
    }
}
