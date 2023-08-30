<?php

namespace App\EventListener;

use App\Entity\OpeningHour;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class OpeningHourListener
{
    private $em;
    private $twig;

    public function __construct(EntityManagerInterface $em, \Twig\Environment $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $openingHours = $this->em->getRepository(OpeningHour::class)->findAll();
        // Ajouter les horaires d'ouverture à l'environnement Twig
        $this->twig->addGlobal('openingHours', $openingHours);
    }
}
