<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CarsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        
        $users = $manager->getRepository(User::class)->findAll();

        // Liste des images disponibles
        $images = [];
        for ($j = 1; $j <= 13; $j++) {
            $images[] = 'voiture' . $j . '.jpg';
        }
        

        for ($i = 0; $i < 20; $i++) {
            $car = new Car();
            $car->setName($faker->vehicle())
                ->setBrand($faker->vehicleBrand())
                ->setPrice($faker->numberBetween(100000, 2500000))
                ->setMiles($faker->randomFloat(0, 10000, 200000))
                ->setDescription($faker->paragraph())
                ->setCaracteristics($faker->paragraph())
                ->setEquipements($faker->paragraph(3, true))
                ->setSlug($faker->slug())
                ->setFuel($faker->vehicleFuelType())
                ->setYear($faker->numberBetween(1995, 2023));

            // Attribuer deux images au hasard à chaque voiture
            shuffle($images);
            $car->setImage([$images[0], $images[1]]);

            // Lier la voiture à un utilisateur aléatoire
            $randomUser = $faker->randomElement($users);
            $car->setCreatedBy($randomUser);
            $car->setCreatedAt(new \DateTimeImmutable('now'));

            $manager->persist($car);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
        ];
    }
}
