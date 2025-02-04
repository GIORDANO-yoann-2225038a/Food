<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $recipes = [
            'Quiche lorraine' => 'crème fraiche, lardons, oeufs, gruyère, pâte feuilletée',
            'Quiche légumes' => 'moutarde, pâte brisée, aubergines, poivrons, fromage',
            'Tarte tomate' => 'moutarde, tomates',
            'Spaghettis carbo' => 'lardons, crème fraiche, spaghettis, parmesan',
            'Spaghettis bolo' => 'viande de boeuf, sauce tomate, spaghettis, oignon',
            'Gnocchi sauce tomate' => 'gnocchi, sauce tomate, oignons',
            'Poulet curry' => 'épices curry, poulet, lait de coco, oignons',
            'Poulet pâtes à la crème' => 'poulet, pâtes, crème fraiche, gruyère, persil',
            'Poke Bowl' => 'saumon, avocat, riz vinaigré, concombre, graines de sésame',
            'Riz Poulet' => 'riz, poulet, haricots, lardons, sauce soja',
            'Salade' => 'salade, tomates, concombre, feta, olives, oignons, vinaigrette',
            'gratin dauhinois' => 'pommes de terre, crème fraiche, ail, gruyère',
            'Steak patate' => 'steak, patate, oignon, ail, persil',
            'Gnocchi de butternut' => 'butternut, farine, parmesan',

        ];

        foreach ($recipes as $title => $ingredients) {
            $recipe = new Recipe();
            $recipe->setTitle($title);
            $recipe->setIngredients($ingredients);
            $manager->persist($recipe);
        }

        $manager->flush();
    }
}
