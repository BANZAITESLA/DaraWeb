<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    function usersalah() {
        /* alert untuk username salah */
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'ID Pegawai salah / tidak terdaftar',
            confirmButtonText: 'Ok',
            iconColor: '#b31200',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
        })
    }

    function passwordsalah() {
        /* alert untuk password salah */
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Password salah / tidak sesuai',
            confirmButtonText: 'Ok',
            iconColor: '#b31200',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
        })
    }

    function dberror() {
        /* alert untuk db not connected */
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Tidak dapat terhubung ke Database. Hubungi Administrator.',
            confirmButtonText: 'Ok',
            iconColor: '#b31200',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
        })
    }

    function logindulu() {
        /* alert untuk no session */

        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Tidak dapat mengakses Sistem. Silahkan Login terlebih dahulu.',
            confirmButtonText: 'Ok',
            iconColor: '#b31200',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../index.php";
            }
        })

    }

    // * alert berhasil
    function resetpassword() {
        /* alert untuk reset password */

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Password berhasil diubah. Silahkan Login kembali.',
            confirmButtonText: 'Ok',
            width: '35%',
            color: '#000000',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "login.php";
            }
        })

    }

    function succesMessage(message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: message,
            confirmButtonText: 'Ok',
            width: '35%',
            color: '#000000',
        })
    }

    function errorMessage(message) {
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: message,
            confirmButtonText: 'Ok',
            iconColor: '#b31200',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
        })
    }
</script>