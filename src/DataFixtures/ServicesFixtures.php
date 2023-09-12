<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $services = [
            [
                'name' => 'Controle Technique',
                'description' => 'Depuis plus de 10ans nous effectuons les contrôles nécessaires à la sécurité de tous.',
                'image' => '../build/images/lifter.8549c5a2.png'
            ],
            [
                'name' => 'Entretien',
                'description' => 'Une voiture bien entretenue, c\'est une voiture qui dure. Avec nous elles le seront.',
                'image' => '../build/images/entretien.fccbc9b7.png'
            ],
            [
                'name' => 'Réparation',
                'description' => 'Nous faisons tout type de réparations avec soins et professionnalisme.',
                'image' => '../build/images/reparer.666fe702.png'
            ],
            [
                'name' => 'Dépanage',
                'description' => 'Un service de dépannage 24h/24h, pour que vous ayez l\'esprit tranquille.',
                'image' => '../build/images/tow-truck.494d34f2.png'
            ],
            [
                'name' => 'Climatisation',
                'description' => 'Une climatisation défectueuse ? Nous pouvons la recharger ou la réparer.',
                'image' => '../build/images/snowflake.ca920b21.png'
            ],
            
        ];
    
        foreach ($services as $servicesData) {
            $service = new Service();
            $service->setName($servicesData['name']);
            $service->setDescription($servicesData['description']);
            $service->setImage($servicesData['image']);
            $service->setCreatedAt(new \DateTimeImmutable('now'));

            $manager->persist($service);
        }
    
        $manager->flush();
    }

}
