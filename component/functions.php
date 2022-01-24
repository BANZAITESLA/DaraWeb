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
