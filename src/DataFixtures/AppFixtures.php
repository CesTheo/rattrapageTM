<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Ville;
use App\Entity\Etudiant;
use App\Entity\Ecole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $ville = new Ville();
            $ville->setNom($faker->city);

            for ($j = 0; $j < 5; $j++) {

                $ecole = new Ecole();
                $ecole->setNom($faker->company)
                    ->setAdresse($faker->address)
                    ->setImage($faker->imageUrl(300, 300, "business"))
                    ->setVille($ville);
                $manager->persist($ecole);

                for($k = 0; $k < 10; $k++){
                    $etudiant = new Etudiant();
                    $etudiant->setPrenom($faker->firstName)
                        ->setNom($faker->lastName)
                        ->setDateNaissance($faker->dateTimeBetween('1950-01-01', '2004-01-01'))
                        ->addEcoleid($ecole);
                    $manager->persist($etudiant);
                }

            }
            $manager->persist($ville);
        }

        $manager->flush();

        $manager->flush();
    }
}
