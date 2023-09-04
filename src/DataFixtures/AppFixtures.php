<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Actualite;
use App\Entity\Equipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; ++$i) {
            $actualite = new Actualite();
            $actualite->setTitre($faker->sentence(3, true));
            $actualite->setDescription($faker->paragraph(3, true));
            $actualite->setDate($faker->dateTimeBetween('-6 months', 'now'));
            $actualite->setImage($faker->imageUrl(640, 480, 'animals', true));
            $manager->persist($actualite);
        
            $equipe = new Equipe();
            $equipe->setNom($faker->sentence(3, true));
            $equipe->setNombreJoueurs($faker->numberBetween(1, 11));
            $equipe->setEntraineur($faker->name());
            $equipe->setCoach($faker->name());
            $manager->persist($equipe);

        }

        $manager->flush();
    }
}
