

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form_contact');
    const errorEmail = document.getElementById('errorEmail');
    function validateFields(email) {
    const errorsE = [];

    if (!email) {
        errorsE.push("Email requis.");
    } else if (!/\S+@\S+\.\S+/.test(email)) {
        errorsE.push("Email invalide.");
    }

    

    return errorsE;
    }


    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        errorEmail.innerHTML = '';

        const name = e.target.name.value;
        const email = e.target.email.value;
        const subject = e.target.subject.value;
        const content = e.target.message.value;

        const errorsE = validateFields(email);
        console.log(errorsE,errorsE.length);
        if (errorsE.length > 0) {
            errorsE.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorEmail.appendChild(li);
            });
            return;
        }
        
        const response = await fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({name, email, subject, content})
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