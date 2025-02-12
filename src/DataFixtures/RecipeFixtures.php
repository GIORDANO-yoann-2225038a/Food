<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $recipe = [
            'Quiche lorraine' => 'crème fraiche, lardons, oeufs, gruyère, pâte feuilletée',
            'Tarte légumes' => 'moutarde, pâte brisée, aubergines, poivrons, fromage',
            'Tarte à la tomate' => 'moutarde, tomates',
            'Spaghettis carbonara' => 'lardons, crème fraiche, spaghettis, parmesan',
            'Spaghettis bolognaise' => 'viande de boeuf, sauce tomate, spaghettis, oignons',
            'Gnocchi sauce tomate' => 'gnocchi, sauce tomate, oignons',
            'Poulet curry' => 'épices curry, poulet, lait de coco, oignons',
            'Poulet pâtes' => 'poulet, pâtes, crème fraiche, gruyère, persil',
            'Poke Bowl' => 'saumon, avocat, riz vinaigré, concombre, graines de sésame',
            'Riz Poulet' => 'riz, poulet, haricots, lardons, sauce soja',
            'Salade' => 'salade, tomates, concombre, feta, olives, oignons, vinaigrette',
            'Gratin dauphinois' => 'pomme de terre, crème fraiche, ail, gruyère',
            'Steak patate' => 'steak, pomme de terre, oignons, ail, persil',
            'Gnocchi de butternut' => 'butternut, farine, parmesan',

        ];

        foreach ($recipe as $title => $ingredients) {
            $recipe = new Recipe();
            $recipe->setTitle($title);
            $recipe->setIngredients($ingredients);
            $manager->persist($recipe);
        }

        $manager->flush();
    }
}
