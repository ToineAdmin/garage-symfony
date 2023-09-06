<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Feedback;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FeedbackFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 15; $i++) {
        $feedback = new Feedback;
        $feedback->setName($faker->name())
                ->setComment($faker->paragraph(3, true))
                ->setRating($faker->numberBetween(4, 5))
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setApproved('true');
        $manager->persist($feedback);
        }

        $manager->flush();
    }
}
