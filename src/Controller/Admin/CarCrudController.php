<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        //rajouter le champ user_id prérempli
        return [
            TextField::new('name', 'Titre'),
            SlugField::new('slug')->setTargetFieldName('name'),
            TextField::new('brand', 'Marque'),
            TextField::new('year', 'Date de mise en circulation'),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setFormTypeOptions([
                    "multiple" => true,
                    "attr" => [
                        "accept" => "image/x-png,image/gif,image/jpeg"
                    ],
                ])
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            MoneyField::new('price', 'Prix')->setCurrency('EUR'),
            IntegerField::new('miles', 'Kilométrage'),
            TextareaField::new('description', 'Description'),
            TextareaField::new('caracteristics', 'Caractéristiques'),
            TextareaField::new('equipements', 'Equipements'),
            TextField::new('createdby', 'Créé par')
                ->setFormTypeOptions([
                'disabled' => true, // Empêche l'édition manuelle
                'data' => $this->getUser()->getId(), // Utilise le nom de l'utilisateur connecté
            ]),
        ];
    }
    
}
