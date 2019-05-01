
if(localStorage.getItem('name') != null)
{
    location.href = window.location.origin + '/itemit/itemit.html';
}

// verificar si estan vacios los datos
function isEmpty(value) {
    if(value == ''){
        return true;
    }else{
        return false;
    }
}

var InputEmail = {

    in: document.getElementById('input-email'),
    span: document.getElementById('email-error'),
    regex: /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i,

    verify: function() {
        this.in.addEventListener('input', () => {
            let field = event.target;

            if(isEmpty(field.value)) {
                this.span.innerText = '-Este campo debe ser llenado';
            } else if(this.regex.test(field.value)) {
                this.span.innerText = '';
            } else {
                this.span.innerText = 'Email Incorrecto';
            }
        })
    }
}

var InputUser = {

    in: document.getElementById('input-user_name'),
    span: document.getElementById('user_name-error'),
    regex: /^(([a-zA-Z0-9](\s|\.)?)*){3,50}$/,

    verify: function() {
        this.in.addEventListener('input', () => {
            let field = event.target;

            if(isEmpty(field.value)) {
                this.span.innerText = '-Este campo debe ser llenado';
            } else if(this.regex.test(field.value)) {
                this.span.innerText = '';
            } else {
                this.span.innerText = 'Nombre de Usuario Invalido';
            }
        })
    }
}

var InputPassword = {

    in: document.getElementById('input-password'),
    span: document.getElementById('password-error'),
    regex: /^[a-zA-Z0-9]+$/,

    verify: function() {
        this.in.addEventListener('input', () => {
            let field = event.target;

            if(isEmpty(field.value)) {
                this.span.innerText = '-Este campo debe ser llenado';
            } else if(this.regex.test(field.value)) {
                this.span.innerText = '';
            } else {
                this.span.innerText = 'Contraseña invalida';
            }
        })
    }
}

var signUpForm = document.getElementById('Form');

// Verificacion en tiempo real de los campos
InputEmail.verify();
InputUser.verify();
InputPassword.verify();

signUpForm.addEventListener('submit', e => {
    e.preventDefault();

    // Verificación de los campos para mandarlos al servidor
    var emailVer = InputEmail.regex.test(InputEmail.in.value);
    var userVer = InputUser.regex.test(InputUser.in.value);
    var passwordVer = InputPassword.regex.test(InputPassword.in.value);

    if(emailVer && userVer && passwordVer) {

        var form = new FormData(signUpForm);

        fetch('http://localhost/itemit/php/signup.php', {
        method: 'POST',
        body: form
        })
        .then(res => {
            return res.json().then(response => {
                return {
                    user: response,
                    status: res.status
                }
            })
        })
        .then(data => {
            console.log(data);
            var divMess = document.createElement('div');
            divMess.setAttribute('id', 'signMessage');

            if(data.user.auth == true)
            {
                localStorage.setItem('name', res.user.name)
                location.href = window.location.origin + '/itemit/itemit.html';
            } else {
                divMess.innerHTML = `Bienvenido ${data.user.name} su cuenta ha sido creada`;
            }
            
            var main = document.querySelector('.signup-page');
            main.insertAdjacentElement("afterbegin", divMess);

            setTimeout(() => {
                divMess.parentNode.removeChild(divMess);
            }, 4000);
        })
        .catch(error => {
            console.log(error);
        })
    } else {
        console.log("datos invalidos");
    }
})
