<html lang="en">
<head>
    <link href="assets/css/style.css?v=1.0" rel="stylesheet">
</head>
<body>
    <?php
        function dbConnect() { /* function untuk koneksi ke db */
            $db = new mysqli("localhost","root","","daraweb"); 
            return $db; 
        }

        function redirect($url) { /* function untuk redirect url jika header tidak berfungsi */
            if (!headers_sent())
            {    
                header('Location: '.$url);
                exit;
                }
            else
                {  
                echo '<script type="text/javascript">';
                echo 'window.location.href="'.$url.'";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
                echo '</noscript>'; exit;
            }
        }
    ?>
    <script>
        // ! alert kesalahan
        function usersalah() { /* alert untuk username salah */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'ID Pegawai salah / tidak terdaftar',
                    confirmButtonText: 'Ok',
                    iconColor : '#b31200',
                    width : '35%',
                    color : '#000000',
                    confirmButtonColor : '#1e3d59',
                })
            });
        }

        function passwordsalah() { /* alert untuk password salah */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Password salah / tidak sesuai',
                    confirmButtonText: 'Ok',
                    iconColor : '#b31200',
                    width : '35%',
                    color : '#000000',
                    confirmButtonColor : '#1e3d59',
                })
            });
        }

        function dberror() { /* alert untuk db not connected */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Tidak dapat terhubung ke Database. Hubungi Administrator.',
                    confirmButtonText: 'Ok',
                    iconColor : '#b31200',
                    width : '35%',
                    color : '#000000',
                    confirmButtonColor : '#1e3d59',
                })
            });
        }

        function logindulu() { /* alert untuk no session */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Tidak dapat mengakses Sistem. Silahkan Login terlebih dahulu.',
                    confirmButtonText: 'Ok',
                    iconColor : '#b31200',
                    width : '35%',
                    color : '#000000',
                    confirmButtonColor : '#1e3d59',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "login.php";
                    }
                })
            });
        }

        // * alert berhasil
        function resetpassword() { /* alert untuk reset password */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'success',
                    title : 'Berhasil',
                    text : 'Password berhasil diubah. Silahkan Login kembali.',
                    confirmButtonText: 'Ok',
                    width : '35%',
                    color : '#000000',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "login.php";
                    }
                })
            });
        }
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
</body>
</html>