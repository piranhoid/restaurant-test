<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $meals = ['Quiche', 'Lasagne', 'Salade', 'Sandwich'];

        foreach ($meals as $meal) {
            $product = new Product();
            $product->setName($meal);
            $product->setRef(strtolower($meal));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
