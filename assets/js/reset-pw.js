(function() {
    const formLogin = document.getElementById('formLogin');
    const username = document.getElementById('username');
    const password1 = document.getElementById('password1');
    const password2 = document.getElementById('password2');
    
    formLogin.addEventListener('submit', e => {
        if (checkInputs() == false) {
            e.preventDefault();
        }
    });

    function checkInputs() {
        const usernameValue = username.value.trim();
        const passwordValue1 = password1.value.trim();
        const passwordValue2 = password2.value.trim();

        if(usernameValue === '') {
            setErrorFor(username, 'ID Pegawai tidak boleh kosong');
            user = false;
        } else {
            setNormalFor(username);
            user = true;
        }

        if(passwordValue1 === '') {
            setErrorFor(password1, 'Password tidak boleh kosong');
            pass1 = false;
        } else {
            setNormalFor(password1);
            pass1 = true;
        }

        if(passwordValue2 === '') {
            setErrorFor(password2, 'Password tidak boleh kosong');
            pass2 = false;
        } else {
            setNormalFor(password2);
            pass2 = true;
        }

        if (passwordValue1 != '' &&  passwordValue2 != '') {
            if (passwordValue1 === passwordValue2) {
                setNormalFor(password1);
                pass1 = true;
                setNormalFor(password2);
                pass2 = true;
            } else {
                setErrorFor(password1, 'Password tidak sama');
                pass1 = false;
                setErrorFor(password2, 'Password tidak sama');
                pass2 = false;
            }
        }

        if (user == false || pass1 == false || pass2 == false) {
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