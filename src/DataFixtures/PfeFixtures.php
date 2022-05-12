<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class PfeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i = 0 ; $i< 50; $i++) {
            $repo = $manager->getRepository(\App\Entity\Entreprise::class);

            $random = rand(1,20);
            $entreprise =$repo->findOneBy(['id'=>"$random"], []);



            $pfe = new \App\Entity\Pfe();

            $pfe->setNomEtudiant($faker->name);
            $pfe->setTitle("PFE" . $i);
            $pfe->setEntreprise($entreprise);
            $manager->persist($pfe);
        }
        $manager->flush();
    }
}
