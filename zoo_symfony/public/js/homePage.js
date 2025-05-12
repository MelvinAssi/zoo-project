document.addEventListener('DOMContentLoaded', function () {
    
    const animalList = document.getElementById('animal_list');
    const template = document.getElementById('animal-card-template');

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
});