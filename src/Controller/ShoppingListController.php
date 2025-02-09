<?php

// src/Controller/ShoppingListController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingListController extends AbstractController
{
    #[Route('/shopping-list', name: 'shopping_list', methods: ['GET'])]
    public function index(SessionInterface $session): \Symfony\Component\HttpFoundation\Response
    {
        // Récupérer les plats stockés dans la session
        $selectedRecipes = $session->get('selectedRecipes', []);

        $ingredientCounts = [];



        // Calcul des ingrédients et de leur quantité
        foreach ($selectedRecipes as $recipe) {
            $ingredients = explode(', ', $recipe['ingredients']); // Suppose que les ingrédients sont séparés par une virgule
            foreach ($ingredients as $ingredient) {
                if (isset($ingredientCounts[$ingredient])) {
                    $ingredientCounts[$ingredient]++;
                } else {
                    $ingredientCounts[$ingredient] = 1;
                }
            }
        }

        return $this->render('shopping_list/index.html.twig', [
            'shoppingList' => $ingredientCounts,
        ]);
    }
}
