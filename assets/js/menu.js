document.addEventListener('DOMContentLoaded', () => {
    const menuGrid = document.getElementById('menu-grid');
    const refreshButton = document.getElementById('refresh-menu');
    const jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

    function chargerMenu() {
        fetch('/api/recipes')
            .then(response => response.json())
            .then(data => {
                const recipes = data.member; // Extraire les recettes

                console.log("Plats disponibles :", recipes);

                if (recipes.length < 7) {
                    console.error("Pas assez de plats disponibles !");
                    menuGrid.innerHTML = `<p class="text-red-500 text-center col-span-7">Pas assez de plats pour générer un menu complet.</p>`;
                    return;
                }

                // Mélanger et prendre 7 plats aléatoires
                const shuffledRecipes = recipes.sort(() => 0.5 - Math.random()).slice(0, 7);

                // Vider le menu actuel
                menuGrid.innerHTML = '';

                shuffledRecipes.forEach((recipe, index) => {
                    const imageName = recipe.title.toLowerCase().replace(/ /g, '_') + '.webp';
                    const imagePath = `/images/${imageName}`;
                    const day = jours[index]; // Associer chaque plat à un jour de la semaine

                    // Création de la carte pour chaque jour de la semaine
                    const card = document.createElement('div');
                    card.className = 'bg-gray-100 shadow-2xl rounded-2xl p-4 flex flex-col items-center w-32 h-32 md:h-80 lg:h-96 transition-transform transform hover:scale-105';                    card.innerHTML = `
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">${day}</h3>
                        <img src="${imagePath}" alt="${recipe.title}" class="w-full h-32 object-cover rounded-md mb-3">
                        <h4 class="text-md font-semibold text-gray-800">${recipe.title}</h4>
                        <p class="text-gray-600 text-sm text-center">${recipe.ingredients}</p>
                    `;

                    menuGrid.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Erreur :', error);
                menuGrid.innerHTML = `<p class="text-red-500 col-span-7 text-center">Impossible de charger le menu.</p>`;
            });
    }

    // Charger le menu au chargement de la page
    chargerMenu();

    // Rafraîchir le menu au clic sur le bouton
    refreshButton.addEventListener('click', chargerMenu);
});
