(function() {
    const formLogin = document.getElementById('formLogin');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    
    formLogin.addEventListener('submit', e => {
        if (checkInputs() == false) {
            e.preventDefault();
        }
    });

    function checkInputs() {
        const usernameValue = username.value.trim();
        const passwordValue = password.value.trim();

        if(usernameValue === '') {
            setErrorFor(username, 'ID Pegawai tidak boleh kosong');
            user = false;
        } else {
            setNormalFor(username);
            user = true;
        }

        if(passwordValue === '') {
            setErrorFor(password, 'Password tidak boleh kosong');
            pass = false;
        } else {
            setNormalFor(password);
            pass = true;
        }

        if (user == false || pass == false) {
            return false;
        } else {
            return true;
        }
    }

    function setErrorFor(input, message) {
        const formControl = input.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'form-control error';
        small.innerText = message;
    }
    
    function setNormalFor(input) {
        const formControl = input.parentElement;
        formControl.className = 'form-control normal';
    }
})()