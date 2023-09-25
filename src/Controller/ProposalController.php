<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Proposal;
use App\Form\ProposalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProposalController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/option-achat/{carId}', name: 'proposal')]
    public function index(Request $request, int $carId): Response
    {

        $car = $this->em->getRepository(Car::class)->find($carId);
        if (!$car) {
            throw $this->createNotFoundException('La voiture demandée n\'existe pas.');
        }

        $proposal = new Proposal();
        $proposal->setCar($car);

        $form = $this->createForm(ProposalType::class, $proposal);
        $form->handleRequest($request);;

        if ($form->isSubmitted() && $form->isValid()) {
            $submittedCarId = $form->get('carId')->getData();


            $this->addFlash('notice', 'Merci de nous avoir contacté, notre équipe va vous répondre dans les meilleurs délais.');
            return $this->redirectToRoute('proposal');
        }

        return $this->render('proposal/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
