<?php
// tests/Repository/CarRepositoryTest.php

namespace App\Tests\Repository;

use App\Data\SearchData;
use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CarRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByName()
    {
        $search = new SearchData();
        $search->q = 'Cadi'; 

        $cars = $this->entityManager
            ->getRepository(Car::class)
            ->findSearch($search);

        $this->assertNotEmpty($cars);
    }



    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }

}
