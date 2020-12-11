<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Menu;
use App\Entity\Pictures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');
        


        for($i = 1; $i <= 12; $i++) {
            $menu = new Menu();

            $name = $faker->sentence();
            $description = $faker->paragraph(10);
            $coverImage = $faker->imageUrl(1000,350);

            $menu->setName($name)
                ->setDescription($description)
                ->setPriceRestaurant(mt_rand(8,25))
                ->setPriceTakeway(mt_rand(10, 30))
                
                ->setPicture($coverImage);

            $manager->persist($menu);
        }

        $manager->flush();
    }
}
