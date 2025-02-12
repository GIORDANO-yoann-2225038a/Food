document.addEventListener('DOMContentLoaded', () => {
    const menuGrid = document.getElementById('menu-grid');
    const refreshButton = document.getElementById('refresh-menu');
    const jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

    function afficherMenu(recipes) {
        menuGrid.innerHTML = '';

        recipes.forEach((recipe, index) => {
            const imageName = recipe.title.toLowerCase().replace(/ /g, '_') + '.webp';
            const imagePath = `/images/${imageName}`;
            const day = jours[index]; // Associer chaque plat à un jour de la semaine

            // Création de la carte du plat
            const card = document.createElement('div');
            card.className = 'bg-gray-100 shadow-2xl rounded-2xl p-4 flex flex-col items-center w-32 h-32 md:h-80 lg:h-96 transition-transform transform hover:scale-105'

            card.innerHTML = `
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">${day}</h3>
                        <img src="${imagePath}" alt="${recipe.title}" class="w-full h-32 object-cover rounded-md mb-3">
                        <h4 class="text-md font-semibold text-gray-800">${recipe.title}</h4>
                        <p class="text-gray-600 text-sm text-center">${recipe.ingredients}</p>
            `;

            menuGrid.appendChild(card);
        });
    }

    function chargerMenu(forceRefresh = false) {
        // Vérifier si un menu est déjà stocké
        const storedRecipes = localStorage.getItem('selectedRecipes');

        if (storedRecipes && !forceRefresh) {
            console.log("Chargement des plats depuis le stockage local...");
            afficherMenu(JSON.parse(storedRecipes));
            return;
        }

        // Si aucun menu stocké ou si on force l'actualisation
        fetch('/api/recipes')
            .then(response => response.json())
            .then(data => {
                const recipes = data.member; // Extraire la liste des recettes

                console.log("Plats disponibles :", recipes);

                if (!recipes || recipes.length < 7) {
                    console.error("Pas assez de plats disponibles !");
                    menuGrid.innerHTML = `<p class="text-red-500 text-center col-span-7">Pas assez de plats pour générer un menu complet.</p>`;
                    return;
                }

                // Mélanger et sélectionner 7 plats aléatoires
                const shuffledRecipes = recipes.sort(() => 0.5 - Math.random()).slice(0, 7);

                // Stocker les plats sélectionnés dans `localStorage`
                localStorage.setItem('selectedRecipes', JSON.stringify(shuffledRecipes));

                // Envoyer les plats au backend pour stockage en session
                fetch('/api/save-selected-recipes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ recipes: shuffledRecipes }),
                })
                    .then(response => response.json())
                    .then(() => console.log('Plats enregistrés en session'))
                    .catch(error => console.error('Erreur lors de l\'enregistrement des plats :', error));

                afficherMenu(shuffledRecipes);
            })
            .catch(error => {
                console.error('Erreur :', error);
                menuGrid.innerHTML = `<p class="text-red-500 col-span-7 text-center">Impossible de charger le menu.</p>`;
            });
    }

    // Charger le menu au chargement de la page
    chargerMenu();

    // Rafraîchir le menu au clic sur le bouton
    refreshButton.addEventListener('click', () => chargerMenu(true));
});
