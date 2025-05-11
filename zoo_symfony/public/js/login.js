

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#form_login');
    const errorEmail = document.getElementById('errorEmail');
    const errorPassword = document.getElementById('errorPassword');
    const errorLogin = document.getElementById('errorLogin');

    function validateFields(email, password) {
    const errorsE = [];
    const errorsP = [];

    if (!email) {
        errorsE.push("Email requis.");
    } else if (!/\S+@\S+\.\S+/.test(email)) {
        errorsE.push("Email invalide.");
    }

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

    return [errorsE, errorsP];
    }


    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        errorEmail.innerHTML = '';
        errorPassword.innerHTML = '';
        errorLogin.innerHTML = '';

        const email = e.target.email.value;
        const password = e.target.password.value;

        const [errorsE,errorsP] = validateFields(email, password);

        if (errorsE.length > 0) {
            errorsE.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorEmail.appendChild(li);
            });
            return;
        }
        if (errorsP.length > 0) {
            errorsP.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorPassword.appendChild(li);
            });
            return;
        }

        const response = await fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email, password })
        });

        if (response.ok) {
            const data = await response.json();
            alert(data.message);
            window.location.href = '/'; // ou autre
        } else {
            const error = await response.text();
            alert('Erreur : ' + error);
        }
    });

});