<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Faker\Factory;
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
                'image' => '../assets/img/lifter.png'
            ],
            [
                'name' => 'Entretien',
                'description' => 'Une voiture bien entretenue, c\'est une voiture qui dure. Avec nous elles le seront.',
                'image' => '../assets/img/entretien.png'
            ],
            [
                'name' => 'Réparation',
                'description' => 'Nous faisons tout type de réparations avec soins et professionnalisme.',
                'image' => '../assets/img/reparer.png'
            ],
            [
                'name' => 'Dépanage',
                'description' => 'Un service de dépannage 24h/24h, pour que vous ayez l\'esprit tranquille.',
                'image' => '../assets/img/tow-truck.png'
            ],
            [
                'name' => 'Vente d\'occasion',
                'description' => 'Notre large game de voitures d\'occasions garanties est à portée de main',
                'image' => '../assets/img/voiture.png'
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
