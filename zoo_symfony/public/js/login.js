import { initializeApp } from "https://www.gstatic.com/firebasejs/11.8.0/firebase-app.js";
import { getFirestore, collection, addDoc, serverTimestamp } from "https://www.gstatic.com/firebasejs/11.8.0/firebase-firestore.js";


document.addEventListener('DOMContentLoaded', function () {

    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);


    const form = document.querySelector('#form_login');
    const errorEmail = document.getElementById('errorEmail');
    const errorPassword = document.getElementById('errorPassword');
    const errorLogin = document.getElementById('errorLogin');


    async function logLoginEvent(email) {
        const userAgent = navigator.userAgent;
        const ipData = await fetch("https://api.ipify.org?format=json").then(res => res.json());
        console.log("IP publique réelle :", ipData.ip);
    try {
        await addDoc(collection(db, "login_logs"), {
            email: email,
            ip: ipData,
            userAgent: navigator.userAgent,
            timestamp: serverTimestamp(),
        });
        console.log("Login event enregistré dans Firestore.");
    } catch (e) {
        console.error("Erreur en enregistrant le log de login :", e);
    }
}
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
        const recaptchaResponse = grecaptcha.getResponse();
        

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

        if (!recaptchaResponse) {
            const li = document.createElement('li');
            li.textContent = "Veuillez valider le reCAPTCHA.";
            errorLogin.appendChild(li);
            return;
        }
        console.log("Token reCAPTCHA :", recaptchaResponse);
        
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email, password, recaptcha: recaptchaResponse })
        });

        if (response.ok) {
            const data = await response.json();
            alert(data.status);
            logLoginEvent(email);
            if (data.status === 'reset_required') {                
                window.location.href = '/firstlogin';
            }else{
                window.location.href = '/api';
            }
            
        } else {
            const error = await response.text();
            alert('Erreur : ' + error);
        }
    });

});