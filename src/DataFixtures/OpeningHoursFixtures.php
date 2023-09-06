<?php

namespace App\DataFixtures;

use App\Entity\OpeningHour;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OpeningHoursFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $weekdays = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
        $saturday = 'Samedi';

        foreach ($weekdays as $day) {
            $openingHour = new OpeningHour();
            $openingHour->setDay($day);
            $openingHour->setIsClosed(false);
            $openingHour->setMorningOpeningTime(new \DateTime('08:00:00'));
            $openingHour->setMorningClosingTime(new \DateTime('12:00:00'));
            $openingHour->setAfternoonOpeningTime(new \DateTime('14:00:00'));
            $openingHour->setAfternoonClosingTime(new \DateTime('18:00:00'));
            $manager->persist($openingHour);
        }

        $openingHourSaturday = new OpeningHour();
        $openingHourSaturday->setDay($saturday);
        $openingHourSaturday->setIsClosed(false);
        $openingHourSaturday->setMorningOpeningTime(new \DateTime('08:00:00'));
        $openingHourSaturday->setMorningClosingTime(new \DateTime('12:00:00'));
        $openingHourSaturday->setAfternoonOpeningTime(null);
        $openingHourSaturday->setAfternoonClosingTime(null);
        $manager->persist($openingHourSaturday);

        $openingHourSunday = new OpeningHour();
        $openingHourSunday->setDay('Dimanche');
        $openingHourSunday->setIsClosed(true);
        $manager->persist($openingHourSunday);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
        ];
    }
}
