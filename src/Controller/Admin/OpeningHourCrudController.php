<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHour;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OpeningHourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHour::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('day', 'Jour'),
            TimeField::new('morningOpeningTime', 'Horaire d\'ouverture'),
            TimeField::new('morningClosingTime', 'Horaire de fermeture'),
            TimeField::new('afternoonOpeningTime', 'Horaire de fermeture'),
            TimeField::new('afternoonClosingTime', 'Horaire de fermeture'),
            BooleanField::new('isClosed', 'Fermé')
        ];
    }

}