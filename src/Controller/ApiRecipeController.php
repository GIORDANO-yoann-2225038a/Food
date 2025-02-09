<?php
namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiRecipeController extends AbstractController
{
    #[Route('/api/recipe', name: 'api_recipe', methods: ['GET'])]
    public function getRecipes(RecipeRepository $recipeRepository): JsonResponse
    {
        // Sélectionner uniquement les champs 'title' et 'ingredients'
        $recipes = $recipeRepository->createQueryBuilder('r')
            ->select('r.title', 'r.ingredients') // Sélection des champs 'title' et 'ingredients'
            ->getQuery()
            ->getArrayResult(); // Récupérer les résultats sous forme de tableau

        return new JsonResponse($recipes); // Retourner la réponse JSON avec les recettes
    }
}



