<?php

namespace App\Controller;

use App\Entity\Feedback;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{

    
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    #[Route('/compte', name: 'account')]
    public function index(): Response
    {
        $feedback = $this->em->getRepository(Feedback::class);
    
        // Comptez les avis non approuvés
        $feedbackCount = $feedback->count(['approved' => false]);
    
        return $this->render('account/index.html.twig', [
            'feedbackCount' => $feedbackCount
        ]);
    }
}
