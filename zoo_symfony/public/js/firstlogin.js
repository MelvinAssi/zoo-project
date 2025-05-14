

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#form_login');
    const errorPassword = document.getElementById('errorPassword');
    const errorLogin = document.getElementById('errorLogin');

    function validateFields(password, confirm_password) {
    const errorsE = [];
    const errorsP = [];


    if (!password) {
        errorsP.push("Mot de passe requis.");
    } else {
        if (password.length < 12) {
            errorsP.push("Mot de passe trop court (minimum 12 caractères).");
        }
        if (!/[a-z]/.test(password)) {
            errorsP.push("Le mot de passe doit contenir au moins une minuscule.");
        }
        if (!/[A-Z]/.test(password)) {
            errorsP.push("Le mot de passe doit contenir au moins une majuscule.");
        }
    }
    if(password !==confirm_password){
        errorsP.push("Les champs doient être identiques");
    }

    return  errorsP;
    }


    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        errorPassword.innerHTML = '';
        errorLogin.innerHTML = '';

        
        const password = e.target.password.value;
        const confirm_password = e.target.confirm_password.value;
        const errorsP = validateFields(password, confirm_password);


        if (errorsP.length > 0) {
            errorsP.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorPassword.appendChild(li);
            });
            return;
        }

        const response = await fetch('/api/firstlogin', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({password})
        });

        if (response.ok) {
            const data = await response.json();
            alert(data.status);
            window.location.href = '/api';

            
        } else {
            const error = await response.text();
            alert('Erreur : ' + error);
        }
    });

});