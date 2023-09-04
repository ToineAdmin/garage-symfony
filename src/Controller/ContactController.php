<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            $prenom = $data['prenom'];
            $nom = $data['nom'];
            $address = $data['email'];
            $content = $data['content'];
        
            // Construction du contenu de l'email
            $mailContent = "De : $prenom $nom\n $content";
        
            $email = (new Email())
                ->from($address)
                ->to('garage-parrot@gmail.com')
                ->subject('Demande de contact')
                ->text($mailContent);
        
            $mailer->send($email);
            $this->addFlash('notice', 'Merci de nous avoir contacté, notre équipe va vous répondre dans les meilleurs délais.');
            return $this->redirectToRoute('contact');
        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
    
}
