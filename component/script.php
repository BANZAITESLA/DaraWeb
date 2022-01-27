<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.AreYouSure/1.9.0/jquery.are-you-sure.min.js" integrity="sha512-YuZemcyQ8r4w8tdxIzkJVgWfHrzSQN9PuF18I490DE8H97DOkrt+bolBf3/mve+9t8SLWODBzFCCPxH/vZYqBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function() {
        $('#formData').areYouSure();
    });

    function successMessage(message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: message,
            confirmButtonText: 'Ok',
            iconColor: '#09791c',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
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

    function redirectMessage(message, url) {
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: message,
            confirmButtonText: 'Ok',
            iconColor: '#b31200',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = url;
            }
        })
    }

    function askRedirectMessage(message, url) {
        Swal.fire({
            icon: 'question',
            title: 'Konfirmasi',
            text: message,
            confirmButtonText: 'Ya',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            iconColor: '#1e3d59',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#09791c',
            cancelButtonColor: '#b31200',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = url;
            }
        })
    }

    function successRedirectMessage(message, url) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: message,
            confirmButtonText: 'Ok',
            iconColor: '#09791c',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }

    function errorRedirectMessage(message, url) {
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: message,
            confirmButtonText: 'Ok',
            iconColor: '#b31200',
            width: '35%',
            color: '#000000',
            confirmButtonColor: '#1e3d59',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = url;
            }
        })
    }

    function updateURLParameter(uri, key, value) {
            // remove the hash part before operating on the uri
            var i = uri.indexOf('#');
            var hash = i === -1 ? '' : uri.substr(i);
            uri = i === -1 ? uri : uri.substr(0, i);

            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";

            if (value === null) {
                // remove key-value pair if value is specifically null
                uri = uri.replace(new RegExp("([?&]?)" + key + "=[^&]*", "i"), '');
                if (uri.slice(-1) === '?') {
                    uri = uri.slice(0, -1);
                }
                // replace first occurrence of & by ? if no ? is present
                if (uri.indexOf('?') === -1) uri = uri.replace(/&/, '?');
            } else if (uri.match(re)) {
                uri = uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                uri = uri + separator + key + "=" + value;
            }
            return uri + hash;
        }
</script>