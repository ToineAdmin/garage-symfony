<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('email', 'Email'),
            TextField::new('Lastname', 'Nom de famille'),
            TextField::new('Firstname','Prénom'),
            TextField::new('plainPassword', 'Mot de passe')->onlyOnForms(),
            TextField::new('job','Métier'),

        ];
    }

}
