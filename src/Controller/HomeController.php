<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]  // Bloque l'accès aux utilisateurs non connectés
    function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'message' => 'User successfully created!'
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): void
    {
        // Symfony gère la déconnexion automatiquement
        throw new \Exception('This should never be reached!');
    }

    #[Route('/api/save-selected-recipes', name: 'save_selected_recipes', methods: ['POST'])]
    public function saveSelectedRecipes(Request $request, SessionInterface $session): JsonResponse
    {
        $selectedRecipes = $request->toArray()['recipes'] ?? [];
        $session->set('selectedRecipes', $selectedRecipes);

        return new JsonResponse(['message' => 'Recettes enregistrées dans la session.']);
    }
}
