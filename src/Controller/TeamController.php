<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/equipe', name: 'team')]
    public function index(): Response
    {
        $users = $this->em->getRepository(User::class)->findAll();
        return $this->render('team/index.html.twig', [
            'users' => $users
        ]);
    }
}
