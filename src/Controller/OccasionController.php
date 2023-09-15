<?php

namespace App\Controller;

use App\Entity\Car;
use App\Data\SearchData;
use App\Form\SearchType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class OccasionController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/voiture-occasion', name: 'occasion')]
    public function index(Request $request): Response
    {
        $data = new SearchData;
        $data->page = $request->get('page', 1);

        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);

        $cars = $this->em->getRepository(Car::class)->findSearch($data);

        if ($request->isXmlHttpRequest()) {
            return $this->render('occasion/single_car.html.twig', [
                'cars' => $cars
            ]);
        }

        return $this->render('occasion/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView()
        ]);
    }
}
