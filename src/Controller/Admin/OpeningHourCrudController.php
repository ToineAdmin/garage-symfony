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
            TimeField::new('morningOpeningTime', 'Horaire d\'ouverture matin')
                ->setHelp('Laissez vide si fermé le matin')
                ->formatValue(function ($value) {
                    if (null === $value) {
                        return 'Fermé';
                    }
                    if ($value instanceof \DateTimeInterface) {
                        return $value->format('H:i');
                    }
                    return $value;
                }),
                
            TimeField::new('morningClosingTime', 'Horaire de fermeture matin')
                ->setHelp('Laissez vide si fermé le matin')
                ->formatValue(function ($value) {
                    if (null === $value) {
                        return 'Fermé';
                    }
                    if ($value instanceof \DateTimeInterface) {
                        return $value->format('H:i');
                    }
                    return $value;
                }),
                
            TimeField::new('afternoonOpeningTime', 'Horaire d\'ouverture après-midi')
                ->setHelp('Laissez vide si fermé l\'après midi')
                ->formatValue(function ($value) {
                    if (null === $value) {
                        return 'Fermé';
                    }
                    if ($value instanceof \DateTimeInterface) {
                        return $value->format('H:i');
                    }
                    return $value;
                }),
                
            TimeField::new('afternoonClosingTime', 'Horaire de fermeture après-midi')
                ->setHelp('Laissez vide si fermé l\'après midi')
                ->formatValue(function ($value) {
                    if (null === $value) {
                        return 'Fermé';
                    }
                    if ($value instanceof \DateTimeInterface) {
                        return $value->format('H:i');
                    }
                    return $value;
                }),
                
            BooleanField::new('isClosed', 'Fermé')
                ->setHelp('Cochez si fermé toute la journée'),
        ];
    }
}
