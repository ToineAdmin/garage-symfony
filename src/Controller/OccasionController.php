<?php

namespace App\Controller;

use App\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OccasionController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/voiture-occasion', name: 'occasion')]
    public function index(): Response
    {

        $cars = $this->em->getRepository(Car::class)->findAll();

        return $this->render('occasion/index.html.twig',[
            'cars' => $cars
        ]);
    }
}
