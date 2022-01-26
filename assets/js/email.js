const formEmail = document.getElementById('formEmail');
const email = document.getElementById('email');

formEmail.addEventListener('submit', function (e) {
    if (checkEmail() == false) {
        e.preventDefault();
    }
});

function checkEmail() {
    var re = /\S+@\S+\.\S+/;
    var res = re.test(email.value.trim());
    console.log(res);
    if (res == true) {
        setNormalFor(email);
        return true;
    } else {
        setErrorFor(email, 'Email tidak valid');
        return false;
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