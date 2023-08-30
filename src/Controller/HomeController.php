<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $services = $this->em->getRepository(Service::class)->findAll();
        $users = $this->em->getRepository(User::class)->findAll();

        return $this->render('home/index.html.twig',[
            'services' => $services,
            'users' => $users
        ]);
    }
}
