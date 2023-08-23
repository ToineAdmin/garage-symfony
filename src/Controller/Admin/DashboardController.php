<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\Service;
use App\Controller\Admin\CarCrudController;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
        }
        return $this->redirect($adminUrlGenerator->setController(CarCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage V.PARROT');
    }

    public function configureMenuItems(): iterable
    {
        if ($this->isGranted('ROLE_ADMIN')) {
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-wrench', Service::class);
        }
        yield MenuItem::linkToUrl('Accueil', 'fas fa-home', '/');
        yield MenuItem::linkToUrl('Mon compte', 'fas fa-house-user', '/compte');
        yield MenuItem::linkToCrud('Voitures', 'fas fa-car', Car::class);
    }
}
