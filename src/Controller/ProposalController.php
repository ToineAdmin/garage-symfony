<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Proposal;
use App\Form\ProposalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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
    public function index(Request $request, int $carId, MailerInterface $mailer): Response
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


            $email = (new TemplatedEmail())
                ->from($proposal->getEmail())
                ->to('garage-parrot@gmail.com')
                ->subject('Nouvelle proposition d\'achat')
                ->htmlTemplate('emails/proposal.html.twig')
                ->context([
                    'proposal' => $proposal,
                ]);

            $mailer->send($email);

            $this->em->persist($proposal);
            $this->em->flush();


            $this->addFlash('notice', 'Merci de nous avoir contacté, notre équipe va vous répondre dans les meilleurs délais.');
            return $this->redirectToRoute('proposal', ['carId' => $carId]);
        }

        return $this->render('proposal/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
