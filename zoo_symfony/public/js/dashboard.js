import { initializeApp } from "https://www.gstatic.com/firebasejs/11.8.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.8.0/firebase-analytics.js";
import { getFirestore, collection, getDocs } from "https://www.gstatic.com/firebasejs/11.8.0/firebase-firestore.js";

window.addEventListener('DOMContentLoaded', async () => {
    const app = initializeApp(firebaseConfig);
    

    const db = getFirestore(app);
    const loginLogsRef = collection(db, "login_logs");

    const tableBody = document.getElementById('table_body');

    try {
        const querySnapshot = await getDocs(loginLogsRef);

        querySnapshot.forEach((doc) => {
            const data = doc.data();
            console.log('IP raw:', data.ip.ip);
            const tr = document.createElement('tr');

            const emailCell = document.createElement('td');
            emailCell.textContent = data.email || '—';

            const ipCell = document.createElement('td');
            ipCell.textContent = data.ip.ip || '—';

            const userAgentCell = document.createElement('td');
            userAgentCell.textContent = data.userAgent || '—';

            const timestampCell = document.createElement('td');
            if (data.timestamp && data.timestamp.seconds) {
                const date = new Date(data.timestamp.seconds * 1000);
                timestampCell.textContent = date.toLocaleString();
            } else {
                timestampCell.textContent = '—';
            }

            tr.appendChild(emailCell);
            tr.appendChild(ipCell);
            tr.appendChild(userAgentCell);
            tr.appendChild(timestampCell);

            tableBody.appendChild(tr);
        });

    } catch (e) {
        console.error("Erreur Firestore :", e);
    }
});
