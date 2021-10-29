<?php

namespace App\DataFixtures;

use App\Entity\Proprietaire;
use App\Entity\Restaurant;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $nbrVilles = 5;
        for ($i = 1; $i <= $nbrVilles; $i++) {
            $ville = new Ville();
            $ville->setNom($faker->city);

            $manager->persist($ville); 

            for ($j = 1; $j <= $nbrVilles; $j++) {
                $proprietaire = new Proprietaire();
                $proprietaire->setNom($faker->lastname);
                $proprietaire->setPrenom($faker->firstname);
                $proprietaire->setDateNaissance($faker->dateTimeThisCentury('- 18 years'));
                $manager->persist($proprietaire);

                $restaurant = new Restaurant();
                $restaurant->setNom($faker->company);
                $restaurant->setAdresse($faker->streetAddress);
                $restaurant->setImage($faker->imageUrl(640, 480, 'business'));
                $restaurant->setVille($ville);
                $restaurant->setProprietaire($proprietaire);
                $manager->persist($restaurant);
            }

        }

        $manager->flush();
    }
}
