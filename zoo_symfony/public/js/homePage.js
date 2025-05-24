document.addEventListener('DOMContentLoaded', function () {
    
    const animalList = document.getElementById('animal_list');
    const template = document.getElementById('animal-card-template');
    const tableBody = document.getElementById('table_body');



    function formatHour(isoString) {
        const date = new Date(isoString);
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false });
    }
    async function getHours() {
        try {
           const response = await fetch('/opening-hours', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

           
            const hours = await response.json();

            hours.forEach(hour => {
                const tr = document.createElement('tr');
                const daysCell = document.createElement('td');
                daysCell.textContent = hour.day || '—';
                const openingCell = document.createElement('td');
                openingCell.textContent = hour.openingTime ? formatHour(hour.openingTime) : '—';

                const endingCell = document.createElement('td');
                endingCell.textContent = hour.closingTime ? formatHour(hour.closingTime) : '—';
                
                tr.appendChild(daysCell);
                tr.appendChild(openingCell);
                tr.appendChild(endingCell);

                tableBody.appendChild(tr);
                
            });





        } catch (error) {
            console.error('Erreur lors de la récupération des horraires :', error);
        }

    };
    async function getAnimal() {
        try {
           const response = await fetch('/animal/random/4', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            const animals = await response.json();
            animalList.innerHTML = '';

            animals.forEach(animal => {
                const clone = template.content.cloneNode(true);
                clone.querySelector('.img_card').src = `/images/animals/${animal.photo}` ; 
                
                clone.querySelector('.img_card').alt = animal.name;
                clone.querySelector('.name_card').textContent = animal.name;
                clone.querySelector('.specie_card').textContent = animal.specie;
                clone.querySelector('.age_card').textContent = `${animal.age} ans`;

                animalList.appendChild(clone);
            });

        } catch (error) {
            console.error('Erreur lors de la récupération des animaux :', error);
        }
    }

    getAnimal();
    getHours();
});