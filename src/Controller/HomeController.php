<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Service;
use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Entity\OpeningHour;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {
        $services = $this->em->getRepository(Service::class)->findAll();
        
        $openingHours = $this->em->getRepository(OpeningHour::class)->findAll();

        $feedbacks = $this->em->getRepository(Feedback::class)->findBy(['approved' => true], ['createdAt' => 'DESC'], 3);


        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($feedback);
            $this->em->flush();

            $this->addFlash('success', 'Merci pour votre avis !');
            return $this->redirectToRoute('home'); 
        }

        return $this->render('base.html.twig',[
            'services' => $services,
            'openingHours' => $openingHours,
            'feedbacks' => $feedbacks,
            'form' => $form->createView()
        ]);
    }
}
