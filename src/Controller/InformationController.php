<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\InformationType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InformationController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/information/{carName?}/{carYear?}/{carPrice}', name: 'information')]
    public function index(Request $request, MailerInterface $mailer, $carName = null, $carYear=null, $carPrice=null): Response
    {

        // Pré remplissage sujet

        $initialData = [];
        if ($carName && $carYear && $carPrice) {
            $initialData['sujet'] = "$carName de $carYear à ". $carPrice/100 . " € ";
        }else if ($carName){
            $initialData['sujet'] = $carName;
        }
    
        $form = $this->createForm(InformationType::class, $initialData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $subject = $data['sujet'];
            $prenom = $data['prenom'];
            $nom = $data['nom'];
            $address = $data['email'];
            $content = $data['content'];

            // Construction du contenu de l'email
            $mailContent = "De : $prenom $nom\n au sujet de $subject \n $content";

            $email = (new Email())
                ->from($address)
                ->to('garage-parrot@gmail.com')
                ->subject('Demande de renseignements')
                ->text($mailContent);

            $mailer->send($email);
            $this->addFlash('notice', 'Merci de nous avoir contacté, notre équipe va vous répondre dans les meilleurs délais.');
            return $this->redirectToRoute('occasion');
        }

        return $this->render('information/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
