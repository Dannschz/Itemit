
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

var loginForm = document.getElementById('Form');

InputEmail.verify();
InputPassword.verify();

loginForm.addEventListener('submit', e => {
    e.preventDefault();

    /* for(var key of form.keys()) {
        console.log(form.get(key));
    } */

    // Verificación de los campos para mandarlos al servidor
    var emailVer = InputEmail.regex.test(InputEmail.in.value);
    var passwordVer = InputPassword.regex.test(InputPassword.in.value);

    if(emailVer && passwordVer) {

        var form = new FormData(loginForm);

        fetch('http://localhost/itemit/php/login.php', {
        method: 'POST',
        body: form
        })
        .then(response => {
            return response.json().then(res => {
                return {
                    user: res,
                    status: response.status
                }
            })
        })
        .then(res => {
            console.log(res);
            var divMess = document.createElement('div');
            divMess.setAttribute('id', 'signMessage');

            if(res.user.auth == true)
            {
                //redireccionar a itemit.html
                localStorage.setItem('name', res.user.name)
                location.href = window.location.origin + '/itemit/itemit.html';
            } else {
                divMess.innerHTML = res.user.message;
            }
            
            var main = document.querySelector('.login-page');
            main.insertAdjacentElement("afterbegin", divMess);

            setTimeout(() => {
                divMess.parentNode.removeChild(divMess);
            }, 4000);
        })
    }
})
console.log(window.location);