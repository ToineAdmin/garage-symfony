<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct( UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        $admin = new User();
        $admin->setEmail('vincent@garage.fr');
        $admin->setLastname('Parrot');
        $admin->setFirstname('Vincent');
        $admin->setJob('Chef d\'atelier');
        $admin->setDescription('Fondateur du Garage, se consacre chaque jour à maintenir le haut niveau d\'expertise de son équipe et la meilleur qualité de service.');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setImage('../uploads/profil-1.jpg');
        $admin->setCreatedAt(new \DateTimeImmutable('now'));

        $manager->persist($admin);

        for ($i = 0; $i < 3; $i++) {
            $employee = new User();
            $employee->setEmail($faker->safeEmail);
            $employee->setLastname($faker->lastName);
            $employee->setFirstname($faker->firstName);
            
            $jobs = ['Mécanicien', 'Secrétaire', 'Commercial'];
            $employee->setJob($faker->randomElement($jobs));
            
            $employee->setDescription(implode(' ', $faker->sentences($nb = rand(2, 3))));
            $employee->setPassword($this->passwordEncoder->hashPassword($employee, 'employe' . ($i + 1)));
            $employee->setRoles(['ROLE_USER']);
            $employee->setImage('../uploads/profil-' . ($i + 2) . '.jpg');  
            $employee->setCreatedAt(new \DateTimeImmutable('now'));
            $manager->persist($employee);
        }
        
        $manager->flush();
        
    }

}
