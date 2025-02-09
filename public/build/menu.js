document.addEventListener('DOMContentLoaded', () => {
    const menuGrid = document.getElementById('menu-grid');
    const refreshButton = document.getElementById('refresh-menu');
    const jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

    function chargerMenu() {
        fetch('/api/recipe')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la récupération des recettes.');
                }
                return response.json();
            })
            .then(recipes => {
                console.log("Plats disponibles :", recipes);

                if (recipes.length < 7) {
                    console.error("Pas assez de plats disponibles !");
                    menuGrid.innerHTML = `<p class="text-red-500">Pas assez de plats pour générer un menu complet.</p>`;
                    return;
                }

                // Mélanger et prendre 7 plats aléatoires
                const shuffledRecipes = recipes.sort(() => 0.5 - Math.random()).slice(0, 7);

                // Stocker les plats sélectionnés dans la session
                fetch('/api/save-selected-recipes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ recipes: shuffledRecipes }),
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Plats enregistrés dans la session.');
                    })
                    .catch(error => {
                        console.error('Erreur lors de l\'enregistrement des plats :', error);
                    });

                // Effacer le menu actuel
                menuGrid.innerHTML = '';

                // Conteneur de la première ligne (4 plats)
                const row1 = document.createElement('div');
                row1.className = 'grid grid-cols-1 md:grid-cols-3 gap-8 justify-center';

                // Conteneur de la deuxième ligne (3 plats, centrés)
                const row2 = document.createElement('div');
                row2.className = 'grid grid-cols-1 md:grid-cols-3 gap-8 justify-center mt-8';

                const row3 = document.createElement('div');
                row3.className = 'grid grid-cols-1 md:grid-cols-1 gap-8 justify-center mt-8';

                shuffledRecipes.forEach((recipe, index) => {
                    const imageName = recipe.title.toLowerCase().replace(/ /g, '_') + '.webp';
                    const imagePath = `/images/${imageName}`;
                    const day = jours[index]; // Associer chaque plat à un jour de la semaine

                    // Création de la carte pour chaque plat
                    const card = document.createElement('div');
                    card.className = 'bg-white shadow-md rounded-lg p-6';

                    card.innerHTML = `
                        <h3 class="text-2xl font-semibold text-center text-gray-800 mb-2">${day}</h3>
                        <img src="${imagePath}" alt="${recipe.title}" class="w-full h-48 object-cover rounded">
                        <h3 class="text-xl font-semibold mt-4">${recipe.title}</h3>
                        <p class="text-gray-600">${recipe.ingredients}</p>
                    `;

                    // Ajouter les plats aux bonnes lignes
                    if (index < 3) {
                        row1.appendChild(card);
                    } else {
                        row2.appendChild(card);
                    }
                });

                // Ajouter les lignes au menuGrid
                menuGrid.appendChild(row1);
                menuGrid.appendChild(row2);
                menuGrid.appendChild(row3);
            })
            .catch(error => {
                console.error('Erreur :', error);
                menuGrid.innerHTML = `<p class="text-red-500">Impossible de charger le menu pour le moment.</p>`;
            });
    }

    // Charger le menu au chargement de la page
    chargerMenu();

    // Rafraîchir le menu au clic sur le bouton
    refreshButton.addEventListener('click', chargerMenu);
});
