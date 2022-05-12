<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class EntrepriseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();
        for($i = 0 ; $i< 20 ; $i++) {
            $entreprise = new \App\Entity\Entreprise();
            $entreprise->setDesignation($faker->company);
            $manager->persist($entreprise);
        }
        $manager->flush();
    }
}
