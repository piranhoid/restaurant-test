<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $restaurant = new Restaurant();
        $restaurant->setName('La bella italia');
        $manager->persist($restaurant);


        $meals = ['Quiche', 'Lasagne', 'Salade', 'Sandwich'];

        foreach ($meals as $meal) {
            $product = new Product();
            $product->setRestaurant($restaurant);
            $product->setName($meal);
            $product->setRef(strtolower($meal));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
